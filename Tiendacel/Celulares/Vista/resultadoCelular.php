<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resultados de búsqueda</title>
</head>

<body>
    <style>
        /* ==========================================================================
   INTERFAZ DE CONSULTA DE DATOS (DATA TABLE COMPONENT)
   ========================================================================== */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        :root {
            --bg-main: #f8fafc;
            /* Fondo claro grisáceo corporativo */
            --surface: #ffffff;
            /* Fondo de la tabla y tarjetas */
            --text-primary: #0f172a;
            /* Texto principal */
            --text-secondary: #64748b;
            /* Encabezados y datos muted */
            --primary: #2563eb;
            /* Azul primario (Botón Volver) */
            --danger: #dc2626;
            /* Rojo para acciones destructivas (Eliminar) */
            --danger-hover: #b91c1c;
            --success-bg: #dcfce7;
            /* Fondo badge activo */
            --success-text: #15803d;
            /* Texto badge activo */
            --muted-bg: #f1f5f9;
            /* Fondo badge inactivo */
            --muted-text: #475569;
            /* Texto badge inactivo */
            --border-soft: #e2e8f0;
            /* Líneas divisorias del software */
            --radius: 8px;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, sans-serif;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-primary);
            min-height: 100vh;
            padding: 2.5rem 2rem;
            max-width: 1300px;
            /* Layout más ancho para visualización de tablas extensas */
            margin: 0 auto;
        }

        /* ==========================================================================
   ENCABEZADO DE LA SECCIÓN
   ========================================================================== */
        h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Sutil indicador de resultados */
        h2::after {
            content: 'REGISTROS EN TIEMPO REAL';
            font-size: 0.65rem;
            font-weight: 600;
            background-color: #f0fdf4;
            color: #166534;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            letter-spacing: 0.05em;
        }

        /* ==========================================================================
   ESTILIZACIÓN DE LA DATA TABLE
   ========================================================================== */
        table {
            width: 100%;
            border-collapse: collapse;
            /* Remueve el espaciado doble de las celdas */
            background-color: var(--surface);
            border-radius: var(--radius);
            overflow: hidden;
            /* Mantiene los bordes redondeados limpios */
            box-shadow: var(--shadow);
            border: 1px solid var(--border-soft);
            margin-bottom: 1rem;
        }

        /* Encabezados de Columna (Headers) */
        th {
            background-color: #f1f5f9;
            color: var(--text-secondary);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1rem 1.25rem;
            text-align: left;
            border-bottom: 2px solid var(--border-soft);
        }

        /* Celdas de Datos (Rows) */
        td {
            padding: 1rem 1.25rem;
            font-size: 0.875rem;
            color: #334155;
            border-bottom: 1px solid var(--border-soft);
            white-space: nowrap;
            /* Evita que el IMEI o fechas se rompan en dos líneas */
        }

        /* Fila interactiva / Zebra Striping */
        tr:nth-child(even) td {
            background-color: #f8fafc;
            /* Alternancia de color sutil */
        }

        tr:hover td {
            background-color: #f1f5f9;
            /* Ilumina la fila donde está parado el cursor */
        }

        /* Destacar la columna de ID y precio */
        td:first-child {
            font-weight: 600;
            color: var(--text-primary);
        }

        td:nth-last-child(3) {
            /* Columna de Precio */
            font-weight: 600;
            color: #0f172a;
        }

        /* Inyección de signo de pesos dinámico al precio */
        td:nth-last-child(3)::before {
            content: '$';
            margin-right: 2px;
        }

        /* ==========================================================================
   TRATAMIENTO DE BOTONES Y BADGES DENTRO DE LA TABLA
   ========================================================================== */

        /* Badges dinámicos para la columna Estado basados en el texto del PHP */
        td:has(text),
        /* Soporte general */
        td {
            /* Si el texto interno es "Activo" o "No Activo", simulamos un badge moderno */
        }

        /* Nota: Como no podemos condicionar CSS puro fácilmente al texto sin clases,
   estilizamos el comportamiento general del texto en la celda de estado */
        td:nth-last-child(2) {
            font-weight: 600;
            font-size: 0.75rem;
        }

        /* Botón Eliminar de la Fila */
        td a button {
            background-color: transparent;
            color: var(--danger);
            border: 1px solid #fca5a5;
            padding: 0.4rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        td a button:hover {
            background-color: var(--danger);
            color: #ffffff;
            border-color: var(--danger);
            box-shadow: 0 2px 4px rgba(220, 38, 38, 0.2);
        }

        /* ==========================================================================
   MENSAJE SIN RESULTADOS Y NAVEGACIÓN INFERIOR
   ========================================================================== */
        p {
            background-color: var(--surface);
            color: var(--text-secondary);
            padding: 2rem;
            text-align: center;
            font-size: 0.95rem;
            border-radius: var(--radius);
            border: 1px dashed #cbd5e1;
            box-shadow: var(--shadow);
        }

        /* Botón Volver (Nivel de Software Global) */
        body>a button {
            background-color: #ffffff;
            color: #334155;
            border: 1px solid var(--border-soft);
            padding: 0.6rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        body>a button:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
            color: var(--text-primary);
            transform: translateX(-2px);
            /* Efecto sutil de retorno hacia la izquierda */
        }

        body>a button::before {
            content: '←';
            font-size: 1rem;
        }

        /* Asegurar scrollbar horizontal si la tabla excede pantallas pequeñas sin romper la interfaz */
        @media (max-width: 768px) {
            body {
                padding: 1.5rem 1rem;
            }

            table {
                display: block;
                overflow-x: auto;
            }
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            /* Espacio entre Editar y Eliminar */
            align-items: center;
        }

        /* Reutilizamos los estilos definidos anteriormente */
        .btn-edit {
            display: inline-block;
            text-decoration: none;
            padding: 0.4rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 6px;
            background-color: #e0f2fe;
            color: #0284c7;
            border: 1px solid #bae6fd;
            transition: all 0.2s ease;
        }

        .btn-edit:hover {
            background-color: #0284c7;
            color: #ffffff;
        }

        .btn-delete-single {
            display: inline-block;
            text-decoration: none;
            padding: 0.4rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 6px;
            background-color: transparent;
            color: var(--danger, #dc2626);
            border: 1px solid #fca5a5;
            transition: all 0.2s ease;
        }

        .btn-delete-single:hover {
            background-color: var(--danger, #dc2626);
            color: #ffffff;
            border-color: var(--danger, #dc2626);
        }
    </style>
    <h2>Resultados encontrados</h2>

    <?php if (isset($resultados) && count($resultados) > 0): ?>

        <table border="1">

            <tr>
                <th>ID</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>IMEI</th>
                <th>Fecha</th>
                <th>Color</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($resultados as $fila): ?>

                <tr>
                    <td><?php echo $fila['id_telefono']; ?></td>
                    <td><?php echo $fila['nombre_modelo']; ?></td>
                    <td><?php echo $fila['nombre_marca']; ?></td>
                    <td><?php echo $fila['IMEI']; ?></td>
                    <td><?php echo $fila['fecha']; ?></td>
                    <td><?php echo $fila['nombre_color']; ?></td>
                    <td><?php echo $fila['precio']; ?></td>
                    <td><?php echo ($fila['id_estado'] == 1) ? 'Activo' : 'No Activo'; ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="../Vista/RegistrarCelular.php?idTelefono=<?php echo $fila['id_telefono']; ?>"
                                class="btn-edit">
                                Editar
                            </a>

                            <a href="../controlador/GuardarEliminarTelefono.php?idTelefono=<?php echo $fila['id_telefono']; ?>"
                                class="btn-delete-single"
                                onclick="return confirm('¿Estás seguro de eliminar este registro?');">
                                Eliminar
                            </a>
                        </div>
                    </td>
                </tr>

            <?php endforeach; ?>

        </table>

    <?php else: ?>

        <p>No se encontraron resultados.</p>

    <?php endif; ?>


    <a href="../../index.php">
        <button style="margin-top: 20px;">Volver</button>
    </a>
</body>

</html>