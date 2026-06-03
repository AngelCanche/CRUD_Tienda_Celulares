<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Resultados de búsqueda</title>
    </head>

    <body>

        <h2>Resultados encontrados</h2>

        <form action="../controlador/guardarEditarStatusPersona.php" method="POST">

        <select name="idPersona" id="idPersona">
            <option value="0">Elija una opción</option>
            <?php foreach($resultados as $fila): ?>
                <option value="<?php echo $fila['id_persona']; ?>"><?php echo $fila['nombres'].' '.$fila['a_paterno'].' '.$fila['a_materno']; ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Desactivar</button>

        </form>

    </body>
</html>