

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Resultados de búsqueda</title>
    </head>

    <body>

    <style>
  /* ==========================================================================
   INTERFAZ DE CONSULTA - TABLA DE VARIANTES DE COLOR (COMPACT DATA)
   ========================================================================== */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

:root {
    --bg-main: #f8fafc;          /* Fondo gris claro corporativo */
    --surface: #ffffff;          /* Fondo de la tabla */
    --text-primary: #0f172a;     /* Texto de datos */
    --text-secondary: #64748b;   /* Encabezados */
    --brand-color: #db2777;      /* Rosa/Magenta representativo del módulo de colores */
    --danger: #dc2626;           /* Rojo para la acción eliminar */
    --border-soft: #e2e8f0;      /* Divisores de celdas */
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
    max-width: 800px; /* Ancho optimizado para tablas de pocas columnas */
    margin: 0 auto;
}

/* ==========================================================================
   ENCABEZADO DE SECCIÓN
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

h2::after {
    content: 'CATÁLOGO DE COLORES';
    font-size: 0.65rem;
    font-weight: 600;
    background-color: #fdf2f8;
    color: var(--brand-color);
    padding: 0.2rem 0.5rem;
    border-radius: 4px;
    letter-spacing: 0.05em;
}

/* ==========================================================================
   ESTILIZACIÓN DE LA DATA TABLE COMPACTA
   ========================================================================== */
table {
    width: 100%;
    border-collapse: collapse;
    background-color: var(--surface);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    border: 1px solid var(--border-soft);
    margin-bottom: 1rem;
}

/* Encabezados */
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

/* Ajustes de ancho proporcionales para que no se desarme visualmente */
th:first-child, td:first-child { width: 15%; }  /* ID corto */
th:last-child, td:last-child { width: 20%; text-align: center; } /* Acciones centradas */

/* Celdas de Datos */
td {
    padding: 1rem 1.25rem;
    font-size: 0.875rem;
    color: #334155;
    border-bottom: 1px solid var(--border-soft);
}

/* Zebra Striping e interactividad */
tr:nth-child(even) td {
    background-color: #f8fafc;
}

tr:hover td {
    background-color: #f1f5f9;
}

/* Resalte de datos clave */
td:first-child {
    font-weight: 600;
    color: var(--text-primary);
}

td:nth-child(2) {
    font-weight: 500;
}

/* ==========================================================================
   BOTONES OPERATIVOS INTERNOS Y DE RETORNO
   ========================================================================== */

/* Botón Eliminar en línea */
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
    display: inline-block;
}

td a button:hover {
    background-color: var(--danger);
    color: #ffffff;
    border-color: var(--danger);
    box-shadow: 0 2px 4px rgba(220, 38, 26, 0.2);
}

/* Contenedor del estado de "Sin registros" */
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

/* Botón de Retorno del Software */
body > a button {
    background-color: #ffffff;
    color: #334155;
    border: 1px solid var(--border-soft);
    padding: 0.6rem 1.25rem;
    font-size: 0.875rem;
    font-weight: 600;
    border-radius: 6px;
    cursor: pointer;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

body > a button:hover {
    background-color: #fdf2f8; /* Tinte sutil rosa en hover */
    border-color: #fbcfe8;
    color: var(--brand-color);
    transform: translateX(-2px);
}

body > a button::before {
    content: '←';
    font-size: 1rem;
}
.action-buttons {
    display: flex;
    gap: 8px;
    align-items: center;
}

/* Estilos de botones unificados */
.btn-edit, .btn-delete-single {
    text-decoration: none;
    padding: 0.4rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 6px;
    transition: all 0.2s ease;
    border: 1px solid transparent;
}

/* Colores específicos */
.btn-edit { background-color: #e0f2fe; color: #0284c7; border-color: #bae6fd; }
.btn-edit:hover { background-color: #0284c7; color: #ffffff; }

.btn-delete-single { background-color: transparent; color: var(--danger, #dc2626); border: 1px solid #fca5a5; }
.btn-delete-single:hover { background-color: var(--danger, #dc2626); color: #ffffff; border-color: var(--danger, #dc2626); }


    </style>

        <h2>Resultados encontrados</h2>

        <?php if(isset($resultados) && count($resultados) > 0): ?>

        <table border="1">

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
            
            
        </tr>

        <?php foreach($resultados as $fila): ?>

        <tr>
            <td><?php echo $fila['id']; ?></td>
            <td><?php echo $fila['nombre_color']; ?></td>
            <td>
    <div class="action-buttons">
        <a href="../vista/registrarColor.php?idColor=<?php echo $fila['id']; ?>" class="btn-edit">
            Editar
        </a>

        <a href="../controlador/GuardarEliminarColores.php?idColor=<?php echo $fila['id']; ?>" 
           class="btn-delete-single"
           onclick="return confirm('¿Estás seguro de que deseas eliminar este color?');">
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