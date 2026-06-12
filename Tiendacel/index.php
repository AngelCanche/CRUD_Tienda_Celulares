<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inico</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <style>
       /* ==========================================================================
   CONFIGURACIÓN GLOBAL Y VARIABLES (Look & Feel de Software Corporativo)
   ========================================================================== */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

:root {
    --bg-main: #f8fafc;          /* Fondo general tipo ERP */
    --bg-sidebar: #0f172a;       /* Azul marino profundo para paneles */
    --primary: #2563eb;          /* Azul brillante para acciones principales */
    --primary-hover: #1d4ed8;
    --text-main: #1e293b;         /* Gris oscuro para alta legibilidad */
    --text-muted: #64748b;        /* Gris secundario para subtítulos o iconos */
    --border-color: #e2e8f0;      /* Separadores sutiles */
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.1), 0 1px 2px rgba(0,0,0,0.06);
    --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}

body {
    background-color: var(--bg-main);
    color: var(--text-main);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2.5rem 1.5rem;
}

/* ==========================================================================
   TITULO PRINCIPAL / HEADER DEL SISTEMA
   ========================================================================== */
h1 {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--bg-sidebar);
    letter-spacing: -0.025em;
    margin-bottom: 2.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    position: relative;
    width: 100%;
    max-width: 1100px;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--border-color);
}

/* Agrega un indicador visual de "Sistema Activo" al lado del título */
h1::after {
    content: 'MÓDULO DE INVENTARIO Y CATÁLOGOS';
    font-size: 0.65rem;
    background-color: #e0f2fe;
    color: #0369a1;
    padding: 0.25rem 0.6rem;
    border-radius: 4px;
    font-weight: 600;
    letter-spacing: 0.05em;
    margin-left: auto;
}

/* ==========================================================================
   CONTENEDOR PRINCIPAL (TRANSFORMACIÓN A GRID DE MÓDULOS)
   ========================================================================== */
/* Selecciona el flujo de enlaces de navegación */
body > a {
    display: contents; /* Permite que los elementos hijos se alineen al grid del contenedor padre real si existiera, o los manejamos de forma limpia */
}

/* Para mantener la estructura limpia sin modificar tu HTML, creamos un layout robusto usando selectores adyacentes */
body {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 1.5rem;
    max-width: 1100px;
    width: 100%;
    align-content: start;
}

h1 {
    grid-column: 1 / -1; /* Obliga al título a ocupar todo el ancho */
}

a {
    text-decoration: none;
    width: 100%;
}

/* ==========================================================================
   COMPONENTES: BOTONES / TARJETAS DE ACCESO DIRECTO
   ========================================================================== */
button {
    width: 100%;
    background-color: #ffffff;
    color: var(--text-main);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 1.75rem 1.5rem;
    font-size: 1.05rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    flex-direction: column; /* Icono arriba, texto abajo para estilo dashboard */
    align-items: flex-start;
    gap: 1.25rem;
    box-shadow: var(--shadow-sm);
    transition: all 0.2s ease-in-out;
    position: relative;
    overflow: hidden;
}

/* Efectos de interacción (Hover y Active) */
button:hover {
    transform: translateY(-3px);
    border-color: var(--primary);
    box-shadow: var(--shadow-md);
    background-color: #fff;
}

button:active {
    transform: translateY(-1px);
    box-shadow: var(--shadow-sm);
}

/* Indicador visual derecho al pasar el cursor (Flecha sutil) */
button::after {
    content: '\f0da'; /* Icono font-awesome fa-caret-right simulado */
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    position: absolute;
    right: 1.5rem;
    bottom: 1.75rem;
    color: var(--text-muted);
    opacity: 0;
    transform: translateX(-5px);
    transition: all 0.2s ease;
}

button:hover::after {
    opacity: 1;
    transform: translateX(0);
    color: var(--primary);
}

/* ==========================================================================
   ESTILIZACIÓN DE ICONOS (Tratamiento individual por módulo)
   ========================================================================== */
button i {
    font-size: 1.75rem;
    padding: 0.75rem;
    border-radius: 10px;
    transition: all 0.2s ease;
    background-color: #f1f5f9;
}

/* Variaciones de color por tipo de módulo para mejorar la navegación intuitiva */
button i.fa-mobile-screen-button {
    color: #2563eb; /* Azul para el producto principal */
    background-color: #eff6ff;
}

button i.fa-tags {
    color: #059669; /* Verde para marcas */
    background-color: #ecfdf5;
}

button i.fa-microchip {
    color: #7c3aed; /* Morado para especificaciones/modelos */
    background-color: #f5f3ff;
}

button i.fa-palette {
    color: #db2777; /* Rosa/Color para variantes */
    background-color: #fdf2f8;
}

button i.fa-cart-shopping {
    color: #d97706; /* Rosa/Color para variantes */
    background-color: #fef3c7;
}


/* Cambios de fondo del icono al hacer hover en la tarjeta */
button:hover i {
    transform: scale(1.05);
}
    </style>

    <h1>Tienda Cel</h1>


    <a href="Celulares/IndexCelulares.php"><button><i class="fa-solid fa-mobile-screen-button"></i> Celulares</button></a>
    <a href="Marcas/IndexMarcas.php"><button><i class="fa-solid fa-tags"></i> Marcas de Celulares</button></a>
    <a href="Modelos/indexModelos.php"><button><i class="fa-solid fa-microchip"></i> Modelos de Celulares</button></a>
    <a href="Colores/indexColores.php"><button><i class="fa-solid fa-palette"></i> Colores</button></a>
    <a href="Ventas/indexVentas.php"><button><i class="fa-solid fa-cart-shopping  "></i> Ventas</button></a>


</body>

</html>