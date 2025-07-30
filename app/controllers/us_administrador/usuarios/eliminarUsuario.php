<?php
// session_start();
require_once __DIR__ . '/../../../models/us_administrador/usuarios/modelUsuarios.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id_personal = $_POST['id_personal'];
        if (Usuarios::eliminarUsuario($id_personal)) {
            $_SESSION['success'] = "Usuario eliminado exitosamente.";
        } else {
            $_SESSION['error'] = "Error al eliminar el usuario.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        error_log(date('[Y-m-d H:i:s] ') . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/../../../logs/error.log');
    }
    header('Location: ' . BASE_URL . 'admin/usuarios');
    exit;
}
?>