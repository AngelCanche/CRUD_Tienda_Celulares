<?php

require_once "../conexionBD.php";

$database = new Conexion();
$db = $database->conectar();

$idPersona = $_POST['idPersona'];

try {

    $sql = "UPDATE tc_personal 
            SET activo = :activo 
            WHERE id_persona = :idPersona LIMIT 1";

    $stmt = $db->prepare($sql);

    $activo = 0;

    $stmt->bindParam(':idPersona', $idPersona);
    $stmt->bindParam(':activo', $activo);

    $stmt->execute();

    echo "Registro actualizado correctamente";

} catch(PDOException $e){

    echo "Error al guardar: " . $e->getMessage();
}

?>