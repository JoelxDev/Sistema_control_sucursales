<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../../config/conexion_db.php';
require_once __DIR__ . '/../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['txtusername'];
    $contrasenia = $_POST['txtcontrasenia'];

    $db = Database::conectarDB();
    $stmt = $db->prepare("SELECT * FROM usuarios WHERE username = :txtusername");
    $stmt->bindParam(':txtusername', $usuario);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $contrasenia === $user['contrasenia']) {
        // Configurar la sesión
        $_SESSION['id_usuario'] = $user['id_usuario']; // Asegúrate de que 'id_usuario' sea el nombre correcto de la columna
        $_SESSION['rol'] = $user['rol']; // Si usas roles, guarda el rol del usuario

        // Redirigir al archivo informacion.php
        header('Location: ' . BASE_URL . 'app/views/usadministrador/informacion/informacion.php');
        exit;
    } else {
        echo "USUARIO O CONTRASEÑA INCORRECTOS";
    }
}
?>