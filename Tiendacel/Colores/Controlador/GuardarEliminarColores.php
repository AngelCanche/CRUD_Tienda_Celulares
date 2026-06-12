<?php

require_once "../../ConexionDb.php";

$database = new Conexion();
$db = $database->conectar();

//Cambiar de POST a GET
$idColor = $_GET['idColor'];


try {

    $sql = "DELETE FROM colores where id = :idColor limit 1";

    $stmt = $db->prepare($sql);

    $stmt->bindParam(':idColor', $idColor);
 

    $stmt->execute();

   echo "
   <style>
/* Estilos generales para las alertas */
.alert {
    padding: 15px 20px;
    margin: 20px 0;
    border-radius: 8px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.5;
    display: flex;
    align-items: center;
    border-left: 5px solid;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Estilo para Éxito */
.success {
    background-color: #d4edda;
    color: #155724;
    border-color: #28a745;
}

/* Estilo para Error */
.error {
    background-color: #f8d7da;
    color: #721c24;
    border-color: #dc3545;
}
   </style>
   
   <div class='alert success'>Registro Eliminado correctamente</div>";

} catch(PDOException $e) {
    echo "<div class='alert error'>Error al guardar: " . $e->getMessage() . "</div>";
}

?>