<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once __DIR__ . '/../config/conexion_db.php';
require_once __DIR__ . '/../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['txtusername'] ?? '');
    $contrasenia = trim($_POST['txtcontrasenia'] ?? '');

    if ($usuario === '' || $contrasenia === '') {
        $_SESSION['login_error'] = "Todos los campos son obligatorios.";
        header('Location: ' . BASE_URL);
        exit;
    }

    $db = Database::conectarDB();

    // Busca el usuario por username
    $stmt = $db->prepare("SELECT * FROM usuarios WHERE username = :txtusername");
    $stmt->bindParam(':txtusername', $usuario);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

// ...código anterior...
if ($user && password_verify($contrasenia, $user['contrasenia'])) {
    $_SESSION['id_usuario'] = $user['id_usuario'];
    $_SESSION['tipo_usuario'] = $user['tipo_usuario'];

    if ($user['tipo_usuario'] === 'administrador') {
        header('Location: ' . BASE_URL . 'admin/informacion');
        exit;
    } else {
        // Solo verifica que la sucursal existe
        $sucursal = trim($_POST['txtsucursal'] ?? '');
        if ($sucursal === '') {
            $_SESSION['login_error'] = "Debes seleccionar una sucursal.";
            header('Location: ' . BASE_URL);
            exit;
        }

        $stmt = $db->prepare("SELECT * FROM sucursal WHERE id_sucursal = :id_sucursal");
        $stmt->bindParam(':id_sucursal', $sucursal, PDO::PARAM_INT);
        $stmt->execute();
        $sucursalData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$sucursalData) {
            $_SESSION['login_error'] = "Sucursal no válida.";
            header('Location: ' . BASE_URL);
            exit;
        }

        $_SESSION['id_sucursal'] = $sucursal;

        // Insertar registro en usuario_sucursal (sin hora_salida)
        $fecha_entrada = date('Y-m-d H:i:s');
        $horario_entrada = date('H:i:s');
        $stmtInsert = $db->prepare("
            INSERT INTO usuario_sucursal (fecha_entrada, horario_entrada, sucursal_id_sucursal, usuarios_id_usuario)
            VALUES (:fecha_entrada, :horario_entrada, :sucursal_id, :usuario_id)
        ");
        $stmtInsert->bindParam(':fecha_entrada', $fecha_entrada);
        $stmtInsert->bindParam(':horario_entrada', $horario_entrada);
        $stmtInsert->bindParam(':sucursal_id', $sucursal, PDO::PARAM_INT);
        $stmtInsert->bindParam(':usuario_id', $user['id_usuario'], PDO::PARAM_INT);
        $stmtInsert->execute();

        header('Location: ' . BASE_URL . 'usuario/informacion');
        exit;
    }
} else {
    $_SESSION['login_error'] = "Usuario o contraseña incorrectos.";
    header('Location: ' . BASE_URL);
    exit;
}
} else {
    $_SESSION['login_error'] = "Acceso no permitido.";
    header('Location: ' . BASE_URL);
    exit;
}
?>