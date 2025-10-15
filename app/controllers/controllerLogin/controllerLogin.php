<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../models/modelLogin/modelLogin.php';
require_once __DIR__ . '/../../models/modelLogin/modelSesion.php'; // SessionModel
require_once __DIR__ . '/../../services/servicioSeguridad.php';    // SecurityService

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['login_error'] = "Acceso no permitido.";
    header('Location: ' . BASE_URL);
    exit;
}

$usuario = trim($_POST['txtusername'] ?? '');
$contrasenia = trim($_POST['txtcontrasenia'] ?? '');
$sucursal = trim($_POST['qr_sucursal_id'] ?? $_POST['txtsucursal'] ?? '');

$ip = SecurityService::getClientIP();
$agente = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

// Campos obligatorios
if ($usuario === '' || $contrasenia === '') {
    $_SESSION['login_error'] = "Todos los campos son obligatorios.";
    header('Location: ' . BASE_URL);
    exit;
}

// Verificar bloqueo (por IP o IP+usuario según tu servicio)
$bloqueo = SecurityService::estaBloqueado($usuario, $ip);
if (!empty($bloqueo['bloqueado'])) {
    $remainingSec = SecurityService::tiempoRestanteBloqueo($usuario, $ip);
    $mins = $remainingSec ? ceil($remainingSec / 60) : 'varios';
    $_SESSION['login_error'] = "Demasiados intentos. Intenta nuevamente en aprox. {$mins} minuto(s).";
    header('Location: ' . BASE_URL);
    exit;
}

// Usar ModelLogin::validarLogin (modelo ya inserta usuario_sucursal y setea $_SESSION cuando aplica)
$resultado = ModelLogin::validarLogin($usuario, $contrasenia, $sucursal);

// Si falla, decidir si contar como intento o solo pedir sucursal
if (empty($resultado['success'])) {
    $errorMsg = $resultado['error'] ?? "Usuario o contraseña incorrectos.";

    // Si el error está relacionado con la selección/validación de sucursal, NO contar como intento fallido
    $isSucursalError = stripos($errorMsg, 'sucursal') !== false;

    if (!$isSucursalError) {
        // registrar intento fallido (log + incrementar)
        SecurityService::registrarIntentoFallido($usuario, $ip, $agente);
    }

    $_SESSION['login_error'] = $errorMsg;
    header('Location: ' . BASE_URL);
    exit;
}



// Login correcto: ModelLogin ya puede haber seteado $_SESSION['id_usuario'] y $_SESSION['id_sucursal']
// Registrar éxito y resetear intentos (no importa si ModelLogin ya insertó usuario_sucursal)
$userId = $_SESSION['id_usuario'] ?? ($resultado['user_id'] ?? null);

// debug: confirmar que llegamos aquí
error_log("controllerLogin: login OK para usuario={$usuario} userId=" . ($userId ?? 'NULL') . " ip={$ip}");

// llamar al servicio y loguear resultado
error_log("DEBUG usuario enviado a registrarExitoYReset: '{$usuario}'");

$logOk = false;
try {
    $usuarioSesion = $_SESSION['usuario'] ?? $usuario;
    $logOk = SecurityService::registrarExitoYReset($usuarioSesion, $ip, $agente, $userId);
    error_log("controllerLogin: registrarExitoYReset returned=" . ($logOk ? 'true' : 'false'));
} catch (Throwable $t) {
    error_log("controllerLogin::registrarExitoYReset exception: " . $t->getMessage());
    $logOk = false;
}

if (!$logOk) {
    error_log("controllerLogin: registro de sesión EXITOSA NO GUARDADO para usuario={$usuario} ip={$ip} userId=" . ($userId ?? 'NULL'));
    // continuar sin impedir el login
}
// Determinar redirección (ModelLogin devuelve 'redirect' en tu implementación)
$redirect = $resultado['redirect'] ?? null;

// Fallback según tipo guardado en sesión
if (empty($redirect)) {
    $tipo = $_SESSION['tipo_usuario'] ?? ($resultado['role'] ?? 'estandar');
    switch ($tipo) {
        case 'superadmin':
        case 'administrador':
            $redirect = 'admin/informacion';
            break;
        case 'inventario':
            $redirect = 'inv/informacion';
            break;
        case 'estandar':
        default:
            $redirect = 'usuario/perfil';
            break;
    }
}

header('Location: ' . BASE_URL . $redirect);
exit;
} catch (Exception $e) {
    error_log("controllerLogin Exception: " . $e->getMessage());
    $_SESSION['login_error'] = "Ocurrió un error inesperado. Intenta nuevamente.";
    header('Location: ' . BASE_URL);
    exit;
}
?>