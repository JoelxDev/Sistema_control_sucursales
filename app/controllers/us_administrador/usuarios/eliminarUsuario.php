<?php
session_start();
require_once __DIR__ . '/../../../models/us_administrador/usuarios/modelUsuarios.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_personal = $_POST['id_personal'];

    if (Usuarios::eliminarUsuario($id_personal)) {
        $_SESSION['success'] = "Usuario eliminado exitosamente.";
    } else {
        $_SESSION['error'] = "Error al eliminar el usuario.";
    }

    header('Location: ' . BASE_URL . 'app/views/usadministrador/usuarios/usuarios.php');
    exit;
}
?>