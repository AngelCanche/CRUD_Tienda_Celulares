<?php
require_once "../conexionBD.php";

$database = new Conexion();
$db = $database->conectar();

// $nombre = $_GET['nombre'];

//Consultar todos los campos y todos los registros
// $sql = "SELECT * FROM tc_personal";

//Consultar campos especificos
// $sql = "SELECT id_persona, nombres, a_paterno, a_materno FROM tc_personal";

//Consultar campos especificos con una condicion
// $sql = "SELECT id_persona, nombres, a_paterno, a_materno 
//         FROM tc_personal WHERE activo = 0";

$sql = "SELECT id_persona, nombres, a_paterno, a_materno 
        FROM tc_personal WHERE nombres LIKE 'm%'";


$stmt = $db->prepare($sql);
// $stmt->bindParam(':nombre', $nombre);
$stmt->execute();

$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once "../vista/resultadoConsulta.php";
?>