<?php

require_once "../conexionBD.php";

$database = new Conexion();
$db = $database->conectar();

//Cambiar de POST a GET
$idPersona = $_GET['idPersona'];

try {

    $sql = "DELETE FROM tc_personal WHERE id_persona = :idPersona LIMIT 1";

    $stmt = $db->prepare($sql);

    $stmt->bindParam(':idPersona', $idPersona);

    $stmt->execute();

    echo "El registro se eliminó correctamente";

} catch(PDOException $e){

    echo "Error al eliminar: " . $e->getMessage();
}

?>