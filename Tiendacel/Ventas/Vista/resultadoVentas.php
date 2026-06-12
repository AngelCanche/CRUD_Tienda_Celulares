<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Ventas</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        h2 {
            color: #2c3e50;
            margin-top: 0;
            border-bottom: 2px solid #eceff1;
            padding-bottom: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            text-align: left;
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #f8f9fa;
            color: #546e7a;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        tr:hover {
            background-color: #fcfdff;
        }

        .badge-id {
            background: #eceff1;
            color: #37474f;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }

        .precio-texto {
            font-weight: 600;
            color: #2e7d32;
        }

        .text-center {
            text-align: center;
        }

        .btn-regresar {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #3498db;
            font-weight: 500;
            font-size: 14px;
        }

        .btn-regresar:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">
        <a href="../indexVentas.php" class="btn-regresar">← Volver a Búsqueda</a>

        <h2>Historial de Ventas Realizadas</h2>

        <?php if (isset($_GET['mensaje'])): ?>
            <div class="alert-success">
                <?php echo htmlspecialchars($_GET['mensaje']); ?>
            </div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th width="80">Folio</th>
                    <th>Fecha y Hora</th>
                    <th>IMEI</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th width="140">Total Vendido</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($ventas) && is_array($ventas) && count($ventas) > 0): ?>
                    <?php foreach ($ventas as $v): ?>
                        <tr>
                            <td><span class="badge-id">#<?php echo $v['id_venta']; ?></span></td>
                            <td><?php echo date("d/m/Y g:i a", strtotime($v['fecha_venta'])); ?></td>
                            <td><?php echo htmlspecialchars($v['IMEI']); ?></td>
                            <td><?php echo htmlspecialchars($v['nombre_marca']); ?></td>
                            <td><?php echo htmlspecialchars($v['nombre_modelo']); ?></td>
                            <td><span class="precio-texto">$ <?php echo number_format($v['precio'], 2); ?> MXN</span></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center" style="color: #90a4ae; padding: 30px;">
                            No se han registrado ventas en el sistema todavía.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>