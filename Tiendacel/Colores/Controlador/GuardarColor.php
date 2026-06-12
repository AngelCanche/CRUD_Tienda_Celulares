<?php
require_once "../../ConexionDB.php";

$database = new Conexion();
$db = $database->conectar();

// 1. Recepción y limpieza de datos (Forzamos a entero el ID para evitar errores de SQL)
$id = (isset($_POST['id']) && $_POST['id'] !== '') ? (int)$_POST['id'] : null;
$nombre = $_POST['nombre'] ?? '';

try {
    if ($id !== null && $id > 0) {
        // LÓGICA DE ACTUALIZACIÓN
        $sql = "UPDATE colores SET nombre_color = :nombre WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    } else {
        // LÓGICA DE INSERCIÓN
        $sql = "INSERT INTO colores (nombre_color) VALUES (:nombre)";
        $stmt = $db->prepare($sql);
    }

    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->execute();

    // MENSAJE DE ÉXITO
    echo "
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');
        :root { --success: #10b981; --bg: #0f172a; --glass: rgba(255, 255, 255, 0.05); }
        body { margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center; background: radial-gradient(circle at 50% 50%, #064e3b 0%, #0f172a 100%); font-family: 'Inter', sans-serif; }
        .success-card { background: var(--glass); backdrop-filter: blur(16px); border: 1px solid rgba(16, 185, 129, 0.3); padding: 30px 50px; border-radius: 20px; text-align: center; box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
        .success-icon { font-size: 3rem; color: var(--success); margin-bottom: 15px; display: block; }
        .success-text { color: #ecfdf5; font-size: 1.25rem; font-weight: 600; }
        .btn-continue { margin-top: 25px; display: inline-block; padding: 12px 24px; background: var(--success); color: white; text-decoration: none; border-radius: 10px; font-weight: 600; transition: all 0.3s ease; }
        .btn-continue:hover { transform: translateY(-2px); box-shadow: 0 10px 15px rgba(16, 185, 129, 0.3); }
    </style>
    <div class='success-card'>
        <span class='success-icon'>✓</span>
        <div class='success-text'>Registro " . ($id ? "actualizado" : "guardado") . " correctamente</div>
        <a href='javascript:history.back()' class='btn-continue'>Continuar</a>
    </div>";

} catch (PDOException $e) {
    // MENSAJE DE ERROR
    echo "
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        :root { --error: #ef4444; --bg: #0f172a; --glass: rgba(255, 255, 255, 0.03); }
        body { margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center; background: radial-gradient(circle at 50% 50%, #450a0a 0%, #0f172a 100%); font-family: 'Inter', sans-serif; padding: 20px; }
        .error-card { background: var(--glass); backdrop-filter: blur(20px); border: 1px solid rgba(239, 68, 68, 0.3); padding: 40px; border-radius: 24px; text-align: center; max-width: 500px; box-shadow: 0 25px 50px rgba(0,0,0,0.7); }
        .error-icon { font-size: 4rem; color: var(--error); margin-bottom: 20px; display: block; }
        .error-message { color: #fca5a5; background: rgba(0,0,0,0.3); padding: 15px; border-radius: 12px; border-left: 4px solid var(--error); text-align: left; }
        .btn-retry { margin-top: 30px; display: inline-block; padding: 14px 30px; border: 1px solid var(--error); color: white; text-decoration: none; border-radius: 12px; font-weight: 600; }
    </style>
    <div class='error-card'>
        <span class='error-icon'>⚠</span>
        <div class='error-message'>Error: " . htmlspecialchars($e->getMessage()) . "</div>
        <a href='javascript:history.back()' class='btn-retry'>Intentar de nuevo</a>
    </div>";
}
?>