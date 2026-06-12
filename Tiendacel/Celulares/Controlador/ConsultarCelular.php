<?php
require_once "../../ConexionDB.php";

$database = new Conexion();
$db = $database->conectar();

// CONSULTA CORREGIDA CON JOINs
$sql = "SELECT 
            t.id_telefono, 
            t.IMEI, 
            t.fecha, 
            t.precio, 
            t.id_estado,
            m.nombre AS nombre_marca, 
            mo.nombre AS nombre_modelo, 
            c.nombre_color
        FROM telefonos t
        INNER JOIN marcas m ON t.id_marca = m.id
        INNER JOIN modelos mo ON t.id_modelo = mo.id
        INNER JOIN colores c ON t.id_color = c.id";

$stmt = $db->prepare($sql);
$stmt->execute();

$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once "../vista/resultadoCelular.php";
?>