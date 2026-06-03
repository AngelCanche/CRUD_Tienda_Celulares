<?php
require_once "../conexionBD.php";

$database = new Conexion();
$db = $database->conectar();

$imei = $_GET['imei'];

//Consutar los datos generales a partit del IMEI
$sql = "SELECT id_sucursal, id_muestra, id_muestra_color, estado, almacen, baja, fecha_registro 
        FROM tc_telefonos_existencias WHERE codigo = :imei LIMIT 1";


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
$idSucursal = $resultado['id_sucursal'];
$estado = $resultado['estado'];
$almacen = $resultado['almacen'];
$baja = $resultado['baja'];

//Validar que el equipo no este dado de baja
if($baja == 1){
    echo 'ERROR: El telefono con IMEI '.$imei.' está dado de baja';
    die();
}

//Consultar el nombre del equipo
$sql = "SELECT nombre 
        FROM tc_telefonos_muestras WHERE id_muestra = :idMuestra LIMIT 1";

$stmt = $db->prepare($sql);
$stmt->bindParam(':idMuestra', $idMuestra);
$stmt->execute();

$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

$nombreTelefono = $resultado['nombre'];

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

require_once "../vista/formularioIMEIdetalles.php";
?>