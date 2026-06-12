<?php
require_once "../../ConexionDB.php";

$database = new Conexion();
$db = $database->conectar();



// consultar todos los campos y todos los registros
 $sql = "SELECT * FROM marcas";


$stmt = $db->prepare($sql);
// $stmt->bindParam(':nombre', $nombre);
$stmt->execute();

$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once "../vista/resultadoMarca.php";
?>