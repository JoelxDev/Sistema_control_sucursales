<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once __DIR__ . '/../../models/modelLogin/modelLogin.php';
require_once __DIR__ . '/../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['txtusername'] ?? '');
    $contrasenia = trim($_POST['txtcontrasenia'] ?? '');
    $sucursal = trim($_POST['qr_sucursal_id'] ?? $_POST['txtsucursal'] ?? '');

    $resultado = ModelLogin::validarLogin($usuario, $contrasenia, $sucursal);

    if ($resultado['success']) {
        // Redirige según tipo de usuario
        header('Location: ' . BASE_URL . $resultado['redirect']);
        exit;
    } else {
        $_SESSION['login_error'] = $resultado['error'];
        header('Location: ' . BASE_URL);
        exit;
    }
} else {
    $_SESSION['login_error'] = "Acceso no permitido.";
    header('Location: ' . BASE_URL);
    exit;
}
?>