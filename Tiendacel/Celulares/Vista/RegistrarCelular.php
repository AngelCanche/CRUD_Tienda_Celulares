<?php
include_once("../../ConexionDB.php");
$database = new Conexion();
$db = $database->conectar();

// Obtenemos el ID si estamos editando
$idCelular = isset($_GET['idTelefono']) ? $_GET['idTelefono'] : null;
$celular = null;

if ($idCelular) {
    $stmt = $db->prepare("SELECT * FROM telefonos WHERE id_telefono = :id");
    $stmt->execute([':id' => $idCelular]);
    $celular = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Obtenemos los catálogos
$marcas = $db->query("SELECT id, nombre FROM marcas ORDER BY nombre ASC")->fetchAll(PDO::FETCH_ASSOC);
$modelos = $db->query("SELECT id, nombre, id_marca FROM modelos ORDER BY nombre ASC")->fetchAll(PDO::FETCH_ASSOC);
$Colores = $db->query("SELECT id, nombre_color FROM colores ORDER BY nombre_color ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Celulares</title>
</head>

<body>

    <style>
       /* ==========================================================================
   INTERFAZ DE CAPTURA - FORMULARIO DE INVENTARIO PROFESIONAL
   ========================================================================== */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap');

:root {
    --bg-main: #f8fafc;          /* Fondo general gris limpio */
    --surface: #ffffff;          /* Fondo del panel del formulario */
    --text-primary: #0f172a;     /* Etiquetas y texto de entrada */
    --text-muted: #64748b;        /* Indicadores de deshabilitado o marcas de agua */
    --primary: #2563eb;          /* Azul de acción principal (Guardar) */
    --primary-hover: #1d4ed8;
    --border-field: #cbd5e1;     /* Bordes de inputs estándar */
    --border-focus: #3b82f6;     /* Color al dar clic en un input */
    --radius: 8px;
    --shadow-card: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
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
    padding: 3rem 1.5rem;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Ocultar las etiquetas de salto de línea heredadas para controlar el flujo por CSS */
br {
    display: none;
}

/* ==========================================================================
   ENCABEZADO DEL FORMULARIO
   ========================================================================== */
h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1.75rem;
    letter-spacing: -0.025em;
    width: 100%;
    max-width: 600px;
    text-align: left;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

h2::before {
    content: '';
    display: inline-block;
    width: 4px;
    height: 1.25rem;
    background-color: var(--primary);
    border-radius: 2px;
}

/* ==========================================================================
   ESTRUCTURA DEL CONTENEDOR FORM
   ========================================================================== */
form {
    background-color: var(--surface);
    width: 100%;
    max-width: 600px;
    padding: 2.5rem;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: var(--shadow-card);
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Diseño en dos columnas para optimizar espacio */
    gap: 1.25rem;
}

/* ==========================================================================
   CONTROL DE CAMPOS DE ENTRADA (INPUTS, SELECTS, LABELS)
   ========================================================================== */
label {
    grid-column: span 2; /* Por defecto, la etiqueta ocupa el ancho completo */
    font-size: 0.85rem;
    font-weight: 600;
    color: #334155;
    margin-bottom: -0.75rem; /* Acerca la etiqueta al input correspondiente */
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

input, select {
    grid-column: span 2; /* Ancho completo por defecto */
    width: 100%;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    color: var(--text-primary);
    background-color: #ffffff;
    border: 1px solid var(--border-field);
    border-radius: var(--radius);
    outline: none;
    transition: all 0.15s ease-in-out;
}

/* Estados de foco interactivos */
input:focus, select:focus {
    border-color: var(--border-focus);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
}

/* Distribución inteligente en rejilla para optimizar espacio en inputs específicos */
label[for="IMEI"], input[name="IMEI"] {
    grid-column: span 2; /* El IMEI requiere espacio completo */
}

/* Colocamos Fecha y Precio lado a lado en la misma fila */
label:nth-of-type(4) { grid-column: span 1; } /* Label Fecha */
input[name="fecha"] { grid-column: span 1; }

label:nth-of-type(5) { grid-column: span 1; } /* Label Precio */
input[name="precio"] { grid-column: span 1; }

/* Tipografía de código especializada para la captura de IMEI numérico */
input[name="IMEI"] {
    font-family: 'JetBrains Mono', 'Courier New', monospace;
    letter-spacing: 0.05em;
}

/* Tratamiento visual estricto para componentes bloqueados o deshabilitados (Filtro dinámico de tu JS) */
select:disabled {
    background-color: #f1f5f9;
    color: var(--text-muted);
    border-color: #e2e8f0;
    cursor: not-allowed;
}

/* ==========================================================================
   BOTONES DE CONTROL Y SISTEMA
   ========================================================================== */

/* Botón Guardar del formulario */
form button[type="submit"] {
    grid-column: span 2;
    margin-top: 0.75rem;
    background-color: var(--primary);
    color: #ffffff;
    border: none;
    padding: 0.85rem;
    font-size: 1rem;
    font-weight: 600;
    border-radius: var(--radius);
    cursor: pointer;
    transition: background-color 0.2s;
    box-shadow: 0 2px 4px rgba(37, 99, 219, 0.2);
}

form button[type="submit"]:hover {
    background-color: var(--primary-hover);
}

form button[type="submit"]:active {
    transform: scale(0.99);
}

/* Botón Volver externo */
body > a {
    text-decoration: none;
    width: 100%;
    max-width: 600px;
    display: block;
}

body > a button {
    width: 100%;
    background-color: transparent;
    color: var(--text-muted);
    border: 1px dashed var(--border-field);
    padding: 0.75rem;
    font-size: 0.9rem;
    font-weight: 500;
    border-radius: var(--radius);
    cursor: pointer;
    transition: all 0.2s;
}

body > a button:hover {
    background-color: #f1f5f9;
    color: var(--text-primary);
    border-style: solid;
}
    </style>

   <title><?= $idCelular ? "Editar" : "Registrar" ?> Celular</title>

    <form action="../controlador/GuardarCelular.php" method="POST">
        <input type="hidden" name="id_telefono" value="<?= $idCelular ?>">

        <label>Marca:</label>
        <select name="id_marca" id="select_marca" required onchange="filtrarModelos()">
            <option value="">-- Seleccione una marca --</option>
            <?php foreach ($marcas as $marca): ?>
                <option value="<?= $marca['id'] ?>" <?= ($celular && $celular['id_marca'] == $marca['id']) ? 'selected' : '' ?>>
                    <?= $marca['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Modelo:</label>
        <select name="id_modelo" id="select_modelo" required disabled>
            <option value="">-- Seleccione primero una marca --</option>
            <?php foreach ($modelos as $modelo): ?>
                <option value="<?= $modelo['id'] ?>" 
                        data-marca="<?= $modelo['id_marca'] ?>" 
                        style="display: none;"
                        <?= ($celular && $celular['id_modelo'] == $modelo['id']) ? 'selected' : '' ?>>
                    <?= $modelo['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Colores:</label>
        <select name="id_color" id="color" required>
            <option value="">-- Seleccione un color --</option>
            <?php foreach ($Colores as $color): ?>
                <option value="<?= $color['id'] ?>" <?= ($celular && $celular['id_color'] == $color['id']) ? 'selected' : '' ?>>
                    <?= $color['nombre_color'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>IMEI:</label>
        <input type="text" name="IMEI" value="<?= $celular['IMEI'] ?? '' ?>" required maxlength="15">

        <!-- <label>Fecha:</label>
        <input type="date" name="fecha" value="<?= $celular['fecha'] ?? date('Y-m-d') ?>" required> -->

        <label>Precio:</label>
        <input type="number" name="precio" value="<?= $celular['precio'] ?? '' ?>" step="0.01" required>

        <button type="submit"><?= $idCelular ? "Actualizar" : "Guardar" ?></button>
    </form>

</body>
<a href="../../index.php">
    <button style="margin-top: 20px;">Volver</button>
</a>

</html>

<script>
        // Función de filtrado
        function filtrarModelos() {
            const marcaSeleccionada = document.getElementById('select_marca').value;
            const selectModelo = document.getElementById('select_modelo');
            const opciones = selectModelo.getElementsByTagName('option');

            if (marcaSeleccionada === "") {
                selectModelo.disabled = true;
            } else {
                selectModelo.disabled = false;
                for (let i = 0; i < opciones.length; i++) {
                    const idMarcaModelo = opciones[i].getAttribute('data-marca');
                    if (idMarcaModelo === marcaSeleccionada || opciones[i].value === "") {
                        opciones[i].style.display = "block";
                    } else {
                        opciones[i].style.display = "none";
                    }
                }
            }
        }

        // Carga inicial para edición
        window.onload = function() {
            const marcaId = document.getElementById('select_marca').value;
            if (marcaId) {
                document.getElementById('select_modelo').disabled = false;
                filtrarModelos();
            }
        };
    </script>

