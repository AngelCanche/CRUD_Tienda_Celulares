<?php
include_once("../../ConexionDB.php");
$database = new Conexion();
$db = $database->conectar();

$idColor = isset($_GET['idColor']) ? $_GET['idColor'] : null;
$nombreColor = "";

// Si hay un ID, cargamos los datos desde la BD
if ($idColor) {
    $stmt = $db->prepare("SELECT nombre_color FROM colores WHERE id = :id");
    $stmt->execute([':id' => $idColor]);
    $fila = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($fila) {
        $nombreColor = $fila['nombre_color'];
    }
}
?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro de Colores</title>
    </head>

    <body>
<style>
/* ==========================================================================
   INTERFAZ DE CAPTURA - ALTA DE NUEVA VARIANTE DE COLOR
   ========================================================================== */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

:root {
    --bg-main: #f8fafc;          /* Fondo limpio de software administrativo */
    --surface: #ffffff;          /* Fondo del panel del formulario */
    --text-primary: #0f172a;     /* Color de texto principal */
    --text-muted: #64748b;        /* Color para la navegación secundaria */
    --brand-color: #db2777;      /* Rosa/Magenta insignia para el módulo de colores */
    --brand-hover: #be185d;
    --border-field: #cbd5e1;     /* Borde pasivo del input */
    --border-focus: #f472b6;     /* Borde activo rosa al dar foco */
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

/* Ignoramos los saltos de línea para maquetar limpiamente con flexbox y márgenes estables */
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
    max-width: 480px; /* Ancho acotado para formularios de campo único */
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
    max-width: 480px;
    padding: 2.25rem;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: var(--shadow-card);
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

/* ==========================================================================
   ETIQUETAS Y CAMPOS DE ENTRADA
   ========================================================================== */
label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #334155;
    text-transform: uppercase;
    letter-spacing: 0.025em;
    margin-bottom: -0.5rem; /* Vincula visualmente la etiqueta al input */
}

input[type="text"] {
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

/* Cambio de estado estético al capturar datos */
input[type="text"]:focus {
    border-color: var(--border-focus);
    box-shadow: 0 0 0 3px rgba(244, 114, 182, 0.2); /* Resplandor sutil rosa */
}

/* ==========================================================================
   BOTONES OPERATIVOS Y SISTEMA
   ========================================================================== */

/* Botón Guardar */
form button[type="submit"] {
    margin-top: 0.5rem;
    background-color: var(--brand-color);
    color: #ffffff;
    border: none;
    padding: 0.85rem;
    font-size: 0.95rem;
    font-weight: 600;
    border-radius: var(--radius);
    cursor: pointer;
    transition: background-color 0.2s;
    box-shadow: 0 2px 4px rgba(219, 39, 119, 0.15);
}

form button[type="submit"]:hover {
    background-color: var(--brand-hover);
}

form button[type="submit"]:active {
    transform: scale(0.99);
}

/* Ajuste del enlace y botón externo Volver */
body > a {
    text-decoration: none;
    width: 100%;
    max-width: 480px;
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
       <h2><?php echo $idColor ? "Editar Color" : "Registro de Colores"; ?></h2>

<form action="../controlador/GuardarColor.php" method="POST">
    
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($idColor); ?>">

    <label>Nombre del color:</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombreColor); ?>" required>

    <button type="submit"><?php echo $idColor ? "Actualizar" : "Guardar"; ?></button>
</form> 
  
    </body>
   <a href="../../index.php">
            <button style="margin-top: 20px;">Volver</button>
        </a>
</html>