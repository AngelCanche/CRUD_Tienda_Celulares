<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Venta de telefonos</title>
    </head>

    <body>

        <h2>Escriba el IMEI</h2>

        <form action="../controlador/consultarVentaTelefonoDetalles.php" method="GET">

            <label>IMEI:</label><br>
            <input type="text" name="imei" id="imei" maxlength="15" required>

            <br><br>

            <button type="submit">Buscar</button>

        </form>

    </body>
</html>