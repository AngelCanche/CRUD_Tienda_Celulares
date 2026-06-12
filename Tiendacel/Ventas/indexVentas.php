<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro de Celulares</title>
    </head>

    <body>

    <style>
/* ==========================================================================
   ARQUITECTURA DE SOFTWARE - MÓDULO PRINCIPAL DE INVENTARIO
   ========================================================================== */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

:root {
    --bg-main: #f1f5f9;           /* Fondo gris claro de software ERP */
    --surface: #ffffff;           /* Fondo de contenedores principales */
    --text-primary: #0f172a;      /* Texto de alta densidad */
    --text-secondary: #475569;    /* Subtítulos e indicadores */
    --brand-primary: #2563eb;     /* Azul tecnológico para el core del sistema */
    --brand-success: #10b981;     /* Verde para altas de inventario */
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
    grid-template-columns: repeat(2, 1fr); /* Divide el panel en Registro y Consulta */
    gap: 2rem;
    max-width: 1000px;
    margin: 0 auto;
    align-content: start;
}

/* Neutraliza el salto de línea para heredar el comportamiento del Grid */
br {
    display: none;
}

/* ==========================================================================
   ENCABEZADOS DE PANEL (TARJETAS INTEGRADAS)
   ========================================================================== */
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
    gap: 0.6rem;
}

/* Indicador de estado del módulo mediante pseudo-elementos */
h2::before {
    content: '';
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
}

/* Panel 1: Registro de producto nuevo */
h2:nth-of-type(1)::before {
    background-color: var(--brand-success);
}

/* Panel 2: Control de Stock / Listado */
h2:nth-of-type(2)::before {
    background-color: var(--brand-primary);
}

/* ==========================================================================
   ENLACES Y CONTENEDORES FLUIDOS
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
    margin-bottom: auto;
}

/* ==========================================================================
   BOTONES DE OPERACIÓN EN PISO DE VENTA
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

/* Botón: Formulario Registro (Entrada de mercancía) */
h2:nth-of-type(1) + a button {
    background-color: #ecfdf5;
    color: var(--brand-success);
    border: 1px solid #a7f3d0;
}

h2:nth-of-type(1) + a button:hover {
    background-color: var(--brand-success);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
}

/* Botón: Ver Lista (Control de Inventario y Ventas) */
h2:nth-of-type(2) + a button {
    background-color: #eff6ff;
    color: var(--brand-primary);
    border: 1px solid #bfdbfe;
}

h2:nth-of-type(2) + a button:hover {
    background-color: var(--brand-primary);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(37, 99, 219, 0.2);
}

/* Feedback táctil/clic */
button:active {
    transform: scale(0.98);
}

/* ==========================================================================
   RESPONSIVIDAD CONTROLADA
   ========================================================================== */
@media (max-width: 640px) {
    body {
        grid-template-columns: 1fr;
        padding: 1.5rem 1rem;
    }
}
    </style>

        <h2>Registrar Venta</h2>

<a href="../Celulares/Controlador/ConsultarVentaTelefonos.php">
    <Button>Formulario registro</Button>
</a>

<br>
 <h2>Lista de Ventas</h2>
<a href="Controlador/ConsultarVenta.php">
    <button>Ver Lista</button>
</a>

    </body>
</html>