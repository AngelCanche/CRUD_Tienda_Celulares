<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Venta de telefonos</title>
</head>

<body>

    <style>
        /* ==========================================================================
   INTERFAZ DE TRANSACCIÓN - CONFIRMACIÓN Y DETALLE DE VENTA
   ========================================================================== */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap');

        :root {
            --bg-main: #f1f5f9;
            /* Fondo gris ERP de punto de venta */
            --surface: #ffffff;
            /* Fondo del contenedor de confirmación */
            --text-primary: #0f172a;
            /* Títulos e información densa */
            --text-secondary: #475569;
            /* Etiquetas secundarias */
            --brand-success: #10b981;
            /* Verde Esmeralda para confirmar la transacción */
            --brand-success-hover: #059669;
            --border-soft: #e2e8f0;
            /* Divisores de campos */
            --radius: 8px;
            --shadow-pos: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
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
            padding: 4rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /* Centrado perfecto para pantallas de mostrador */
        }

        /* Omitimos los saltos de línea manuales para controlar la separación exacta mediante Grid/Flex */
        br {
            display: none;
        }

        /* ==========================================================================
   TARJETA DE CONFIRMACIÓN (TRANSACTION CARD)
   ========================================================================== */
        form {
            background-color: var(--surface);
            width: 100%;
            max-width: 460px;
            /* Caja compacta y sumamente legible */
            padding: 2.5rem;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: var(--shadow-pos);
            display: flex;
            flex-direction: column;
            gap: 1.15rem;
        }

        /* ==========================================================================
   ENCABEZADO DE VALIDACIÓN (H2 REPOSICIONADO AL TOP)
   ========================================================================== */
        h2 {
            font-size: 1.35rem;
            font-weight: 700;
            color: #1e293b;
            letter-spacing: -0.025em;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            order: -2;
            /* Fuerza al título a renderizarse arriba de todo dentro del contenedor flex */
        }

        h2::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 1.15rem;
            background-color: var(--brand-success);
            border-radius: 2px;
        }

        /* ==========================================================================
   ESTILOS DE ETIQUETAS Y CAMPOS DE ENTRADA
   ========================================================================== */
        label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: -0.6rem;
            /* Vincula de forma estrecha la etiqueta a su input */
        }

        input[type="text"] {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            color: #334155;
            background-color: #f8fafc;
            /* Apariencia gris de "campo informativo" o deshabilitado */
            border: 1px solid var(--border-soft);
            border-radius: var(--radius);
            outline: none;
            transition: all 0.15s ease-in-out;
        }

        /* Tratamiento tipográfico especializado para el IMEI cargado del PHP */
        input#imei {
            font-family: 'JetBrains Mono', 'Courier New', monospace;
            letter-spacing: 0.05em;
            color: var(--text-primary);
            font-weight: 500;
            background-color: #f1f5f9;
            /* Fondo ligeramente más denso para el ID inmutable */
            cursor: not-allowed;
            /* Indica que el IMEI ya fue procesado y no debe editarse aquí */
        }

        /* Resalte visual premium para la caja de cobro (Precio) */
        label:nth-of-type(3),
        input:has([value*="MXN"]),
        input[value*="MXN"] {
            /* Identifica el input que contiene el formato de moneda formateado por PHP */
        }

        input[value*="MXN"] {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.35rem;
            /* Incremento drástico para validar el cobro al cliente */
            font-weight: 600;
            color: #065f46;
            /* Texto verde oscuro contable */
            background-color: #f0fdf4;
            /* Fondo verde claro de éxito financiero */
            border-color: #bbf7d0;
            text-align: center;
            /* Centrado absoluto para evitar confusiones de dígitos */
        }

        /* ==========================================================================
   BOTÓN DISPARADOR DE TRANSACCIÓN (VENDER)
   ========================================================================== */
        form button[type="submit"] {
            margin-top: 0.75rem;
            background-color: var(--brand-success);
            color: #ffffff;
            border: none;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: var(--radius);
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        form button[type="submit"]:hover {
            background-color: var(--brand-success-hover);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        form button[type="submit"]:active {
            transform: scale(0.98);
        }

        /* Icono sutil de confirmación (Checkmark) inyectado por CSS puro */
        form button[type="submit"]::before {
            content: '✓';
            font-size: 1.1rem;
            font-weight: 700;
        }
    </style>

    <h2>Escriba el IMEI</h2>

    <form action="../controlador/guardarVentaTelefono.php" method="POST">

        <label>IMEI:</label><br>
        <input type="text" id="imei" name="imei" value="<?php echo $imei; ?>">

        <br>

        <label for="marca">Marca:</label><br>
        <input type="text" id="marca" name="marca" value="<?php echo htmlspecialchars($nombreMarca); ?>" readonly>
        <br><br>

        <label for="modelo">Modelo / Nombre:</label><br>
        <input type="text" id="modelo" name="modelo" value="<?php echo htmlspecialchars($nombreTelefono); ?>" readonly>
        <br><br>
        <label>Precio:</label><br>
        <input type="text" value="$ <?php echo number_format($precio, 2); ?> MXN">

        <br><br>

        <button type="submit">Vender</button>

    </form>

</body>

</html>