<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Resultados de búsqueda</title>
    </head>

    <body>

        <h2>Resultados encontrados</h2>

        <?php if(count($resultados) > 0): ?>

        <table border="1">

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
        </tr>

        <?php foreach($resultados as $fila): ?>

        <tr>
            <td><?php echo $fila['id_persona']; ?></td>
            <td><?php echo $fila['nombres']; ?></td>
            <td><?php echo $fila['a_paterno']; ?></td>
            <td><?php echo $fila['a_materno']; ?></td>
        </tr>

        <?php endforeach; ?>

        </table>

        <?php else: ?>

        <p>No se encontraron resultados.</p>

        <?php endif; ?>

    </body>
</html>