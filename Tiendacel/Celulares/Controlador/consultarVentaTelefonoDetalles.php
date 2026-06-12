<?php
require_once "../../conexionDB.php";

$database = new Conexion();
$db = $database->conectar();

// Validar que el IMEI exista en la URL y no venga vacío
$imei = isset($_GET['imei']) ? trim($_GET['imei']) : '';

if (empty($imei)) {
    echo 'ERROR: El parámetro IMEI es requerido.';
    die();
}

// 1. Consulta corregida: Se cambió el alias 'mod' por 'mo' para evitar la palabra reservada
$sql = "SELECT t.id_telefono, t.id_modelo, t.id_marca, t.id_color, t.id_estado, t.fecha, t.precio,
               m.nombre AS nombre_marca,
               mo.nombre AS nombre_modelo
        FROM telefonos t
        LEFT JOIN marcas m ON t.id_marca = m.id
        LEFT JOIN modelos mo ON t.id_modelo = mo.id
        WHERE t.IMEI = :imei 
        LIMIT 1";

$stmt = $db->prepare($sql);
$stmt->bindParam(':imei', $imei);
$stmt->execute();

$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

// Validar que se haya encontrado el teléfono con ese IMEI
if ($resultado == false) {
    echo 'ERROR: No se encontraron resultados para el IMEI ' . htmlspecialchars($imei);
    die();
}

// Crear las variables con los datos obtenidos de la base de datos
$idTelefono   = $resultado['id_telefono'];
$idModelo     = $resultado['id_modelo'];
$idMarca      = $resultado['id_marca'];
$idColor      = $resultado['id_color'];
$idEstado     = $resultado['id_estado'];
$fecha        = $resultado['fecha'];
$precio       = $resultado['precio'];

// Guardamos los nombres comerciales obtenidos
$nombreMarca    = $resultado['nombre_marca'] ? $resultado['nombre_marca'] : "Marca No Asignada";
$nombreTelefono = $resultado['nombre_modelo'] ? $resultado['nombre_modelo'] : "Modelo No Asignado";

// Cargar la vista para mostrar los detalles en pantalla
require_once "../vista/formularioIMEIdetalles.php";
?>