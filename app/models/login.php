<?php
// if (session_status() !== PHP_SESSION_ACTIVE) {
//     session_start();
// }

// require_once __DIR__ . '/../../config/conexion_db.php';
// require_once __DIR__ . '/../../config/config.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $usuario = $_POST['txtusername'];
//     $contrasenia = $_POST['txtcontrasenia'];

//     $db = Database::conectarDB();
//     $stmt = $db->prepare("SELECT * FROM usuarios 
//     WHERE username = :txtusername");
//     $stmt->bindParam(':txtusername', $usuario);
//     $stmt->execute();
//     $user = $stmt->fetch(PDO::FETCH_ASSOC);

//     // if ($user && $contrasenia === $user['contrasenia']) {
//     if ($user && password_verify ($contrasenia, $user['contrasenia'])) {
//         // Configurar la sesión
//         $_SESSION['id_usuario'] = $user['id_usuario']; // Asegúrate de que 'id_usuario' sea el nombre correcto de la columna
//         $_SESSION['tipo_usuario'] = $user['tipo_usuario']; // Si usas roles, guarda el rol del usuario

//         // Redirigir según el tipo de usuario
//     if ($user['tipo_usuario'] === 'administrador') {
//         header('Location: ' . BASE_URL . 'app/views/usadministrador/informacion/informacion.php');
//     } else {
//         header('Location: ' . BASE_URL . 'app/views/usestandar/informacionUE/informacionUE.html');
//     }
//     exit;
//     } else {
//         echo "USUARIO O CONTRASEÑA INCORRECTOS";
//     }
// }
?>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../../config/conexion_db.php';
require_once __DIR__ . '/../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['txtusername'] ?? '');
    $contrasenia = trim($_POST['txtcontrasenia'] ?? '');

    if ($usuario === '' || $contrasenia === '') {
        $_SESSION['login_error'] = "Usuario y contraseña son obligatorios.";
        header('Location: ' . BASE_URL . 'app/views/login.php');
        exit;
    }

    $db = Database::conectarDB();
    $stmt = $db->prepare("SELECT * FROM usuarios WHERE username = :txtusername");
    $stmt->bindParam(':txtusername', $usuario);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($contrasenia, $user['contrasenia'])) {
        $_SESSION['id_usuario'] = $user['id_usuario'];
        $_SESSION['tipo_usuario'] = $user['tipo_usuario'];

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