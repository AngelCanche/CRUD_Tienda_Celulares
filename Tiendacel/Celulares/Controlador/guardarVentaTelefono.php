<?php
require_once "../../conexionDB.php";

$database = new Conexion();
$db = $database->conectar();

// Validar que se reciban los datos obligatorios por POST
$imei = isset($_POST['imei']) ? trim($_POST['imei']) : '';
$precio = isset($_POST['precio']) ? trim($_POST['precio']) : '';

if (empty($imei)) {
    echo 'ERROR: El parámetro IMEI es requerido para procesar la venta.';
    die();
}

try {
    // Iniciar una transacción para asegurar que ambas consultas se cumplan juntas
    $db->beginTransaction();

    // 1. Obtener el id_telefono a partir del IMEI para poder guardarlo en la tabla venta
    $sqlSelect = "SELECT id_telefono FROM telefonos WHERE IMEI = :imei LIMIT 1";
    $stmtSelect = $db->prepare($sqlSelect);
    $stmtSelect->bindParam(':imei', $imei);
    $stmtSelect->execute();
    $telefono = $stmtSelect->fetch(PDO::FETCH_ASSOC);

    if (!$telefono) {
        throw new Exception("No se encontró ningún equipo registrado con el IMEI proporcionado.");
    }

    $idTelefono = $telefono['id_telefono'];
    $fechaActual = date("Y-m-d H:i:s");

    // 2. Insertar en la tabla venta (Corregido a singular basándose en tu imagen)
    $sqlInsertVenta = "INSERT INTO ventas (id_telefono, fecha_venta) VALUES (:id_telefono, :fecha_venta)";
    $stmtInsert = $db->prepare($sqlInsertVenta);
    $stmtInsert->bindParam(':id_telefono', $idTelefono);
    $stmtInsert->bindParam(':fecha_venta', $fechaActual);
    $stmtInsert->execute();

    // 3. Actualizar el campo id_estado a 0 (No disponible) en la tabla telefonos
    $sqlUpdateEstado = "UPDATE telefonos SET id_estado = 0 WHERE id_telefono = :id_telefono";
    $stmtUpdate = $db->prepare($sqlUpdateEstado);
    $stmtUpdate->bindParam(':id_telefono', $idTelefono);
    $stmtUpdate->execute();

    // Si ambas consultas fueron exitosas, confirmar los cambios en la base de datos
    $db->commit();

    // Redireccionar a la vista de todas las ventas con un mensaje de éxito
    echo "
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

    :root {
        --success: #10b981; 
        --bg: #0f172a;
        --glass: rgba(255, 255, 255, 0.05);
    }

    body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: var(--bg);
        background-image: radial-gradient(circle at 50% 50%, #064e3b 0%, #0f172a 100%);
        font-family: 'Inter', sans-serif;
    }

    .success-card {
        background: var(--glass);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(16, 185, 129, 0.3); 
        padding: 30px 50px;
        border-radius: 20px;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 
                    0 0 20px rgba(16, 185, 129, 0.1);
        animation: slideUp 0.5s ease-out;
    }

    .success-icon {
        font-size: 3rem;
        color: var(--success);
        margin-bottom: 15px;
        display: block;
    }

    .success-text {
        color: #ecfdf5;
        font-size: 1.25rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .btn-continue {
        margin-top: 25px;
        display: inline-block;
        padding: 12px 24px;
        background: var(--success);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-continue:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px rgba(16, 185, 129, 0.3);
        filter: brightness(1.1);
    }
    </style>
    <div class='success-card'>
        <span class='success-icon'>✓</span>
        <div class='success-text'>¡Venta registrada con éxito!</div>
        <br>
        <a href='../../ventas/indexVentas.php' class='btn-continue'>Ver Historial de Ventas</a>
    </div>
    ";

} catch (Exception $e) {
   
    $db->rollBack();
    mostrarTarjetaError($e->getMessage());
}


function mostrarTarjetaError($mensajeDeError) {
    echo "
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

    :root {
        --error: #ef4444; 
        --bg: #0f172a;
        --glass: rgba(255, 255, 255, 0.03);
    }

    body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: var(--bg);
        background-image: radial-gradient(circle at 50% 50%, #450a0a 0%, #0f172a 100%);
        font-family: 'Inter', sans-serif;
        padding: 20px;
    }

    .error-card {
        background: var(--glass);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(239, 68, 68, 0.3);
        padding: 40px;
        border-radius: 24px;
        text-align: center;
        max-width: 500px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7),
                    0 0 20px rgba(239, 68, 68, 0.1);
        animation: shake 0.4s cubic-bezier(.36,.07,.19,.97) both;
    }

    .error-icon {
        font-size: 4rem;
        color: var(--error);
        margin-bottom: 20px;
        display: block;
        filter: drop-shadow(0 0 10px rgba(239, 68, 68, 0.5));
    }

    .error-title {
        color: #fee2e2;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .error-message {
        color: #fca5a5;
        font-family: 'Courier New', Courier, monospace; 
        font-size: 0.95rem;
        background: rgba(0, 0, 0, 0.3);
        padding: 15px;
        border-radius: 12px;
        border-left: 4px solid var(--error);
        word-break: break-all;
        text-align: left;
    }

    @keyframes shake {
        10%, 90% { transform: translate3d(-1px, 0, 0); }
        20%, 80% { transform: translate3d(2px, 0, 0); }
        30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
        40%, 60% { transform: translate3d(4px, 0, 0); }
    }

    .btn-retry {
        margin-top: 30px;
        display: inline-block;
        padding: 14px 30px;
        background: transparent;
        color: white;
        border: 1px solid var(--error);
        text-decoration: none;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-retry:hover {
        background: var(--error);
        box-shadow: 0 0 20px rgba(239, 68, 68, 0.4);
        transform: translateY(-2px);
    }
    </style>
    <div class='error-card'>
        <span class='error-icon'>⚠</span>
        <div class='error-title'>Error Crítico</div>
        <div class='error-message'>" . htmlspecialchars($mensajeDeError) . "</div>
        <a href='javascript:history.back()' class='btn-retry'>Intentar de nuevo</a>
    </div>
    ";
}
    exit();

?>  