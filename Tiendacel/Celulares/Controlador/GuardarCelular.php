<?php
require_once "../../ConexionDB.php";

$database = new Conexion();
$db = $database->conectar();

// 1. Recibimos el ID
$id_telefono = isset($_POST['id_telefono']) && !empty($_POST['id_telefono']) ? $_POST['id_telefono'] : null;

// 2. Recibimos datos
$marca = $_POST['id_marca'];
$modelo = $_POST['id_modelo'];
$IMEI = $_POST['IMEI'];
$color = $_POST['id_color'];
$precio = $_POST['precio'];
$estado = 1;
$fecha_actual = date('Y-m-d'); // Fecha automática

try {
    if ($id_telefono) {
        // --- CASO UPDATE ---
        $sql = "UPDATE telefonos SET 
                id_modelo = :id_modelo, 
                id_marca = :id_marca, 
                id_color = :id_color, 
                IMEI = :IMEI, 
                fecha = :fecha, 
                precio = :precio 
                WHERE id_telefono = :id_telefono";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_telefono', $id_telefono);
        $mensaje = "Registro actualizado correctamente";
    } else {
        // --- CASO INSERT ---
        $sql = "INSERT INTO telefonos (id_modelo, id_marca, id_color, IMEI, id_estado, fecha, precio)
                VALUES (:id_modelo, :id_marca, :id_color, :IMEI, :id_estado, :fecha, :precio)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_estado', $estado);
        $mensaje = "Registro guardado correctamente";
    }

    // Parámetros comunes (incluyendo la fecha automática)
    $stmt->bindParam(':id_modelo', $modelo);
    $stmt->bindParam(':id_marca', $marca);
    $stmt->bindParam(':id_color', $color);
    $stmt->bindParam(':IMEI', $IMEI);
    $stmt->bindParam(':fecha', $fecha_actual); // <-- Usamos la fecha automática siempre
    $stmt->bindParam(':precio', $precio);

    $stmt->execute();

    echo "
    <style>
        .msg-box { max-width: 400px; margin: 50px auto; padding: 25px; text-align: center; border-radius: 12px; font-family: sans-serif; background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn { display: inline-block; margin-top: 15px; padding: 10px 20px; background: #22c55e; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; }
    </style>
    <div class='msg-box'>
        <h3>¡Éxito!</h3>
        <p>$mensaje</p>
        <a href='../../index.php' class='btn'>Volver al inicio</a>
    </div>";

} catch(PDOException $e) {
    // Si ocurre un error, mostramos el mensaje de error (mantenlo como lo tenías)
    echo "<div style='color:red; text-align:center; padding:20px;'>Error al procesar: " . $e->getMessage() . "</div>";
}
?>