<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Venta de telefonos</title>
    </head>

    <body>

    <style>
        /* ==========================================================================
   INTERFAZ DE VENTA - PANEL DE CONTROL Y BÚSQUEDA POR IMEI
   ========================================================================== */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap');

:root {
    --bg-main: #f1f5f9;          /* Fondo gris claro de software de punto de venta */
    --surface: #ffffff;          /* Fondo del contenedor de búsqueda */
    --text-primary: #0f172a;     /* Títulos e información densa */
    --text-muted: #64748b;        /* Subtítulos e indicadores */
    --brand-sale: #2563eb;       /* Azul tecnológico para el flujo de ventas */
    --brand-hover: #1d4ed8;
    --border-field: #cbd5e1;     /* Contorno pasivo del input */
    --border-focus: #3b82f6;     /* Enfoque activo */
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
    justify-content: center; /* Centra el panel verticalmente para pantallas de mostrador */
}

/* Omitimos los saltos de línea nativos para controlar las separaciones por CSS */
br {
    display: none;
}

/* ==========================================================================
   CONTENEDOR DE BÚSQUEDA (SEARCH CARD)
   ========================================================================== */
form {
    background-color: var(--surface);
    width: 100%;
    max-width: 440px;            /* Caja compacta y enfocada */
    padding: 2.5rem;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: var(--shadow-pos);
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

/* ==========================================================================
   RESTRUCTURACIÓN DEL ENCABEZADO DENTRO DE LA TARJETA
   ========================================================================== */
h2 {
    font-size: 1.35rem;
    font-weight: 700;
    color: #1e293b;
    letter-spacing: -0.025em;
    margin-bottom: 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    
    /* Movemos visualmente el h2 al tope interno del formulario */
    order: -2; 
}

h2::before {
    content: '';
    display: inline-block;
    width: 4px;
    height: 1.15rem;
    background-color: var(--brand-sale);
    border-radius: 2px;
}

/* ==========================================================================
   ELEMENTOS DE ENTRADA Y CAPTURA
   ========================================================================== */
label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: -0.5rem;
    order: -1;
}

input[type="text"] {
    width: 100%;
    padding: 0.85rem 1rem;
    font-size: 1.1rem;          /* Texto ligeramente más grande para lectura clara */
    font-family: 'JetBrains Mono', 'Courier New', monospace; /* Tipografía técnica */
    color: var(--text-primary);
    background-color: #ffffff;
    border: 1px solid var(--border-field);
    border-radius: var(--radius);
    outline: none;
    letter-spacing: 0.08em;     /* Separa los números del IMEI para evitar fatiga visual */
    transition: all 0.15s ease-in-out;
    text-align: center;         /* Centra el código numérico para máxima legibilidad */
}

/* Efecto de iluminación al escanear o tipear */
input[type="text"]:focus {
    border-color: var(--border-focus);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    background-color: #f8fafc;
}

/* Cambia el color del borde si el campo tiene datos válidos (opcional/nativo) */
input[type="text"]:valid {
    border-color: #94a3b8;
}

/* ==========================================================================
   BOTÓN DE ACCIÓN PRINCIPAL (TRIGGER)
   ========================================================================== */
form button[type="submit"] {
    margin-top: 0.5rem;
    background-color: var(--brand-sale);
    color: #ffffff;
    border: none;
    padding: 0.9rem;
    font-size: 0.95rem;
    font-weight: 600;
    border-radius: var(--radius);
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 4px 6px -1px rgba(37, 99, 219, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

form button[type="submit"]:hover {
    background-color: var(--brand-hover);
    box-shadow: 0 4px 12px rgba(37, 99, 219, 0.3);
}

form button[type="submit"]:active {
    transform: scale(0.98);
}

/* Glifo de lupa minimalista inyectado por CSS para el botón Buscar */
form button[type="submit"]::before {
   
    display: inline-block;
    width: 14px;
    height: 14px;
    border: 2px solid #ffffff;
    border-radius: 50%;
    position: relative;
    transform: rotate(-45deg);
}
    </style>

        <h2>Escriba el IMEI</h2>

        <form action="../controlador/consultarVentaTelefonoDetalles.php" method="GET">

            <label>IMEI:</label><br>
            <input type="text" name="imei" id="imei" maxlength="15" required>

            <br><br>

            <button type="submit">Buscar</button>

        </form>

    </body>
</html>