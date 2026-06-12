<?php
require_once "../../ConexionDB.php";

$database = new Conexion();
$db = $database->conectar();

// Consulta avanzada para armar el reporte de ventas con nombres legibles
$sql = "SELECT v.id AS id_venta, v.fecha_venta, 
               t.IMEI, t.precio,
               m.nombre AS nombre_marca,
               mo.nombre AS nombre_modelo
        FROM ventas v
        INNER JOIN telefonos t ON v.id_telefono = t.id_telefono
        LEFT JOIN marcas m ON t.id_marca = m.id
        LEFT JOIN modelos mo ON t.id_modelo = mo.id
        ORDER BY v.fecha_venta DESC";

$stmt = $db->prepare($sql);
$stmt->execute();
$ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once "../vista/resultadoVentas.php";
?>