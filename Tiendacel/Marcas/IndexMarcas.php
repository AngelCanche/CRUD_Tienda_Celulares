<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro de Marcas</title>
    </head>

    <body>
<style>
/* ==========================================================================
   CONFIGURACIÓN INDUSTRIAL Y ARQUITECTURA VISUAL
   ========================================================================== */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

:root {
    --bg-main: #f1f5f9;           /* Fondo gris claro de software ERP */
    --surface: #ffffff;           /* Fondo de contenedores principales */
    --text-primary: #0f172a;      /* Texto de alta densidad */
    --text-secondary: #475569;    /* Subtítulos e indicadores */
    --brand-emerald: #059669;     /* Verde corporativo para registros/altas */
    --brand-blue: #3b82f6;        /* Azul corporativo para consultas/listas */
    --border-soft: #e2e8f0;       /* Separadores de componentes */
    --radius-lg: 12px;
    --radius-md: 8px;
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
    padding: 3rem 2rem;
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Divide la pantalla en dos paneles operativos */
    gap: 2rem;
    max-width: 1000px;
    margin: 0 auto;
    align-content: start;
}

/* Ocultar el salto de línea obsoleto para no romper la estructura Grid */
br {
    display: none;
}

/* ==========================================================================
   TÍTULOS / SECCIONES DE ACCIÓN
   ========================================================================== */
/* Modificamos los h2 para que actúen como el encabezado de cada tarjeta */
h2 {
    grid-column: span 1;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    background-color: var(--surface);
    padding: 1.5rem 1.5rem 0.5rem 1.5rem;
    border-top-left-radius: var(--radius-lg);
    border-top-right-radius: var(--radius-lg);
    border: 1px solid var(--border-soft);
    border-bottom: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Identificadores visuales únicos mediante pseudo-elementos (Alternativa si no hay FontAwesome) */
h2::before {
    content: '';
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
}

/* Primer panel: Registro */
h2:nth-of-type(1)::before {
    background-color: var(--brand-emerald);
}

/* Segundo panel: Listado */
h2:nth-of-type(2)::before {
    background-color: var(--brand-blue);
}

/* ==========================================================================
   CONTENEDORES DE ENLACES Y ENVOLTURAS
   ========================================================================== */
a {
    text-decoration: none;
    display: block;
    background-color: var(--surface);
    padding: 0 1.5rem 1.5rem 1.5rem;
    border-bottom-left-radius: var(--radius-lg);
    border-bottom-right-radius: var(--radius-lg);
    border: 1px solid var(--border-soft);
    border-top: none;
    box-shadow: var(--shadow);
    margin-bottom: auto; /* Alinea perfectamente si los paneles varían de tamaño */
}

/* ==========================================================================
   BOTONES OPERATIVOS DEL SISTEMA
   ========================================================================== */
button {
    width: 100%;
    padding: 1rem;
    font-size: 0.95rem;
    font-weight: 600;
    border-radius: var(--radius-md);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease-in-out;
}

/* Comportamiento específico para el Botón de Registro */
h2:nth-of-type(1) + a button {
    background-color: #ecfdf5;
    color: var(--brand-emerald);
    border: 1px solid #a7f3d0;
}

h2:nth-of-type(1) + a button:hover {
    background-color: var(--brand-emerald);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2);
}

/* Comportamiento específico para el Botón de Visualización/Consulta */
h2:nth-of-type(2) + a button {
    background-color: #eff6ff;
    color: var(--brand-blue);
    border: 1px solid #bfdbfe;
}

h2:nth-of-type(2) + a button:hover {
    background-color: var(--brand-blue);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
}

/* Efecto de presión en software */
button:active {
    transform: scale(0.98);
}

/* ==========================================================================
   RESPONSIVE DESIGN (Para terminales de inventario o tabletas)
   ========================================================================== */
@media (max-width: 640px) {
    body {
        grid-template-columns: 1fr; /* Cambia a una sola columna en pantallas móviles */
        padding: 1.5rem 1rem;
    }
}
</style>
        <h2>Registro de Marcas</h2>

<a href="Vista/RegistrarMarca.php">
    <Button>Formulario registro</Button>
</a>

<br>
 <h2>Lista de Marcas</h2>
<a href="Controlador/ConsultarMarca.php">
    <button>Ver Lista</button>
</a>

    </body>
</html>