<?php

require_once "../conexionBD.php";

$database = new Conexion();
$db = $database->conectar();

//Cambiar de POST a GET
$imei = $_POST['imei'];
$estado = 1;
$idSucursal = 1;
$idUsuario = 1;
$estadoCaja = 1;
$tipoMovimiento = 1;
$cambio = 0;

//Obtener los detalles a partir del imei
// Consutar los datos generales a partit del IMEI
$sql = "SELECT id_prod, id_muestra, estado
        FROM tc_telefonos_existencias 
        WHERE codigo = :imei LIMIT 1";

$stmt = $db->prepare($sql);
$stmt->bindParam(':imei', $imei);
$stmt->execute();

$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

//Validar que se haya encontrado al menos un registro
if($resultado == false){
    echo 'ERROR: No se encontraron resultados para el IMEI '.$imei;
    die();
}

//Crear variables para los resultados obtenidos en la consulta
$idMuestra = $resultado['id_muestra'];
$idProducto = $resultado['id_prod'];
$estado = $resultado['estado'];

//Validar que se haya encontrado al menos un registro
if($estado == 1){
    echo 'ERROR: El IMEI '.$imei.' ya está vendido';
    die();
}

$estado = 1;

//Consultar el precio del telefono
$sql = "SELECT precio 
        FROM tc_telefonos_precio 
        WHERE id_muestra = :idMuestra 
        AND id_sucursal = :idSucursal LIMIT 1";

$stmt = $db->prepare($sql);
$stmt->bindParam(':idMuestra', $idMuestra);
$stmt->bindParam(':idSucursal', $idSucursal);
$stmt->execute();

$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

$precio = $resultado['precio'];

try{
    $db->beginTransaction(); //Punto de restauración

    //Actualizar campo estado
    $sql = "UPDATE tc_telefonos_existencias SET estado = :estado WHERE id_prod = :idProducto LIMIT 1";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':idProducto', $idProducto);
    $stmt->execute();

    //Guardar la venta en la tabla de telefonos venta
    $sql = "INSERT INTO tc_telefonos_venta (id_sucursal, id_usuario, id_prod, id_muestra, precio_venta) 
            VALUES (:idSucursal, :idUsuario, :idProducto, :idMuestra, :precio)";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':idSucursal', $idSucursal);
    $stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->bindParam(':idProducto', $idProducto);
    $stmt->bindParam(':idMuestra', $idMuestra);
    $stmt->bindParam(':precio', $precio);
    $stmt->execute();

    //Obtener el id de la caja activa
    $sql = "SELECT id_caja, cantidad_cierre FROM tc_caja WHERE estado = :estadoCaja LIMIT 1";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':estadoCaja', $estadoCaja);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    $idCaja = $resultado['id_caja'];
    $cantidadCierre = $resultado['cantidad_cierre'];

    //Guardamos el movimiento en tc_caja_movimientos
    $sql = "INSERT INTO tc_caja_movimientos (tipo_movimiento, id_caja, id_sucursal, id_usuario, cobro, pagado, cambio)
            VALUES (:tipoMovimiento, :idCaja, :idSucursal, :idUsuario, :cobro, :pagado, :cambio)";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':tipoMovimiento', $tipoMovimiento);
    $stmt->bindParam(':idCaja', $idCaja);
    $stmt->bindParam(':idSucursal', $idSucursal);
    $stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->bindParam(':cobro', $precio);
    $stmt->bindParam(':pagado', $precio);
    $stmt->bindParam(':cambio', $cambio);
    $stmt->execute();

    //calcular la nueva cantidad de cierre
    $nuevaCantidadCierre = $cantidadCierre + $precio;

    //actualiza cantidad cierre
    $sql = "UPDATE tc_caja SET cantidad_cierre = :cantidadCierre WHERE id_caja = :idCaja LIMIT 1";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':cantidadCierre', $nuevaCantidadCierre);
    $stmt->bindParam(':idCaja', $idCaja);
    $stmt->execute();

    $db->commit();
    echo "Venta guardada correctamente";

}
catch(Exception $e){
    $db->rollBack();
    echo "ERROR: ".$e->getMessage();
}


?>