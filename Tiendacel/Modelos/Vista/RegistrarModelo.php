<?php
include_once("../../ConexionDB.php");
$database = new Conexion();
$db = $database->conectar();

// Ahora sí captura el 'id' correctamente
$idModelo = isset($_GET['id']) ? $_GET['id'] : null;
$nombreModelo = "";
$idMarcaSeleccionada = "";

if ($idModelo) {
    $stmt = $db->prepare("SELECT nombre, id_marca FROM modelos WHERE id = :id");
    $stmt->execute([':id' => $idModelo]); // Aquí usas la variable corregida
    $modelo = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($modelo) {
        $nombreModelo = $modelo['nombre'];
        $idMarcaSeleccionada = $modelo['id_marca'];
    }
}
?>  


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Modelos</title>
</head>

<body>

    <style>
        /* ==========================================================================
    INTERFAZ DE CAPTURA - REGISTRO DE MODELOS Y RELACIÓN DE MARCAS
    ========================================================================== */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        :root {
            --bg-main: #f8fafc;
            /* Fondo gris claro tipo ERP */
            --surface: #ffffff;
            /* Fondo del panel del formulario */
            --text-primary: #0f172a;
            /* Color de texto principal */
            --text-muted: #64748b;
            /* Color para la navegación secundaria o deshabilitados */
            --brand-color: #7c3aed;
            /* Morado/Violeta corporativo para el módulo de modelos */
            --brand-hover: #6d28d9;
            --border-field: #cbd5e1;
            /* Borde pasivo de inputs */
            --border-focus: #a78bfa;
            /* Borde activo morado al dar foco */
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
            padding: 4rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Ignoramos las etiquetas nativas <br> para delegar el espaciado al layout flexible de CSS */
        br {
            display: none;
        }

        /* ==========================================================================
    ENCABEZADO DE SECCIÓN
    ========================================================================== */
        h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1.5rem;
            letter-spacing: -0.025em;
            width: 100%;
            max-width: 520px;
            /* Ancho idóneo para formularios de mediana densidad */
            text-align: left;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        h2::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 1.25rem;
            background-color: var(--brand-color);
            border-radius: 2px;
        }

        /* ==========================================================================
    ESTRUCTURA DEL PANEL DEL FORMULARIO
    ========================================================================== */
        form {
            background-color: var(--surface);
            width: 100%;
            max-width: 520px;
            padding: 2.5rem;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: var(--shadow-card);
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            /* Separación simétrica entre bloques de campos */
        }

        /* ==========================================================================
    ETIQUETAS Y CAMPOS DE ENTRADA (INPUTS / SELECTS)
    ========================================================================== */
        label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #334155;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            margin-bottom: -0.5rem;
            /* Vincula visualmente la etiqueta al input abajo de ella */
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            color: var(--text-primary);
            background-color: #ffffff;
            border: 1px solid var(--border-field);
            border-radius: var(--radius);
            outline: none;
            transition: all 0.15s ease-in-out;
            appearance: none;
            /* Limpia estilos nativos raros en selectores de algunos sistemas */
        }

        /* Flecha personalizada sutil para el elemento Select en sistemas profesionales */
        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23475569'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.25rem;
            padding-right: 2.5rem;
        }

        /* Cambios de estado estéticos interactivos al enfocar campos */
        input[type="text"]:focus,
        select:focus {
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.15);
            /* Resplandor sutil violeta */
        }

        /* ==========================================================================
    BOTONES OPERATIVOS Y SISTEMA
    ========================================================================== */

        /* Botón Guardar */
        form button[type="submit"] {
            margin-top: 0.75rem;
            background-color: var(--brand-color);
            color: #ffffff;
            border: none;
            padding: 0.85rem;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: var(--radius);
            cursor: pointer;
            transition: background-color 0.2s;
            box-shadow: 0 2px 4px rgba(124, 58, 237, 0.15);
        }

        form button[type="submit"]:hover {
            background-color: var(--brand-hover);
        }

        form button[type="submit"]:active {
            transform: scale(0.99);
        }

        /* Ajuste del enlace y botón externo Volver */
        body>a {
            text-decoration: none;
            width: 100%;
            max-width: 520px;
            display: block;
        }

        body>a button {
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

        body>a button:hover {
            background-color: #f1f5f9;
            color: var(--text-primary);
            border-style: solid;
        }
    </style>

   <h2><?php echo $idModelo ? "Editar Modelo" : "Registro de Modelos"; ?></h2>

<form action="../controlador/GuardarModelo.php" method="POST">
    
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($idModelo); ?>">

    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombreModelo); ?>" required>
    
    <label>Marca:</label>
    <select name="id_marca" required>
        <option value="">-- Seleccione una marca --</option>
        <?php
        $sql = "SELECT id, nombre FROM marcas ORDER BY nombre ASC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Comparamos si esta marca es la que tiene el modelo
            $selected = ($fila['id'] == $idMarcaSeleccionada) ? "selected" : "";
            echo "<option value='" . $fila['id'] . "' $selected>" . $fila['nombre'] . "</option>";
        }
        ?>
    </select>

    <button type="submit"><?php echo $idModelo ? "Actualizar" : "Guardar"; ?></button>
</form>

</body>
<a href="../../index.php">
    <button style="margin-top: 20px;">Volver</button>
</a>

</html>