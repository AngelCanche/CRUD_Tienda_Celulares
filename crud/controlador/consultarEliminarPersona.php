<?php
require_once "../conexionBD.php";

$database = new Conexion();
$db = $database->conectar();

$sql = "SELECT id_persona, nombres, a_paterno, a_materno, activo 
        FROM tc_personal";


$stmt = $db->prepare($sql);
// $stmt->bindParam(':nombre', $nombre);
$stmt->execute();

$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once "../vista/resultadoEliminarConsulta.php";
?>