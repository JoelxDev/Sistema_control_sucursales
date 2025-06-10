<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../../config/conexion_db.php';
require_once __DIR__ . '/../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['txtusername'] ?? '');
    $contrasenia = trim($_POST['txtcontrasenia'] ?? '');
    $sucursal = trim($_POST['txtsucursal'] ?? '');

    if ($usuario === '' || $contrasenia === '' || $sucursal === '') {
        $_SESSION['login_error'] = "Todos los campos son obligatorios.";
        header('Location: ' . BASE_URL . 'app/views/login.php');
        exit;
    }

    $db = Database::conectarDB();

    // Verifica que la sucursal existe y está activa
    $stmt = $db->prepare("SELECT * FROM sucursal WHERE id_sucursal = :id_sucursal AND estado_s = 'activo'");
    $stmt->bindParam(':id_sucursal', $sucursal, PDO::PARAM_INT);
    $stmt->execute();
    $sucursalData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$sucursalData) {
        $_SESSION['login_error'] = "Sucursal no válida o inactiva.";
        header('Location: ' . BASE_URL . 'app/views/login.php');
        exit;
    }

    // Verifica usuario
    $stmt = $db->prepare("SELECT * FROM usuarios WHERE username = :txtusername");
    $stmt->bindParam(':txtusername', $usuario);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($contrasenia, $user['contrasenia'])) {
        $_SESSION['id_usuario'] = $user['id_usuario'];
        $_SESSION['tipo_usuario'] = $user['tipo_usuario'];
        $_SESSION['id_sucursal'] = $sucursal;

        // Registra entrada en usuario_sucursal
        $hora_entrada = date('H:i:s');
        $fecha = date('Y-m-d H:i:s');
        $stmt = $db->prepare("INSERT INTO usuario_sucursal (fecha_entrada, horario_entrada, sucursal_id_sucursal, usuarios_id_usuario) VALUES (:fecha, :hora_entrada, :sucursal, :usuario)");
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora_entrada', $hora_entrada);
        $stmt->bindParam(':sucursal', $sucursal, PDO::PARAM_INT);
        $stmt->bindParam(':usuario', $user['id_usuario'], PDO::PARAM_INT);
        $stmt->execute();

        switch ($user['tipo_usuario']) {
            case 'administrador':
                header('Location: ' . BASE_URL . 'app/views/usadministrador/informacion/informacion.php');
                break;
            case 'estandar':
                header('Location: ' . BASE_URL . 'app/views/usestandar/informacionUE/informacionUE.php');
                break;
            default:
                header('Location: ' . BASE_URL . 'public/index.php');
                break;
        }
        exit;
    } else {
        $_SESSION['login_error'] = "Usuario o contraseña incorrectos.";
        header('Location: ' . BASE_URL . 'app/views/login.php');
        exit;
    }
}
?>