<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Venta de telefonos</title>
    </head>

    <body>

        <h2>Escriba el IMEI</h2>

        <form action="../controlador/guardarVentaTelefono.php" method="POST">

            <label>IMEI:</label><br>
            <input type="text" id="imei" name="imei" value="<?php echo $imei; ?>" >

            <br>

            <label>Nombre:</label><br>
            <input type="text" value="<?php echo $nombreTelefono; ?>">

            <br>

            <label>Precio:</label><br>
            <input type="text" value="$ <?php echo number_format($precio, 2); ?> MXN">

            <br><br>

            <button type="submit">Vender</button>

        </form>

    </body>
</html>