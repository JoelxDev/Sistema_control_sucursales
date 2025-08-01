<?php
// session_start();
require_once __DIR__ . '/../../../models/us_administrador/usuarios/modelUsuarios.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id_personal = $_POST['id_personal'];
        $nombre_p = $_POST['nombre_p'];
        $apellido_p = $_POST['apellido_p'];
        $telefono_p = $_POST['telefono_p'];
        $roll_p = $_POST['roll_p'];

        if (Usuarios::editarUsuario($id_personal, $nombre_p, $apellido_p, $telefono_p, $roll_p)) {
            $_SESSION['success'] = "Usuario editado exitosamente.";
        } else {
            $_SESSION['error'] = "Error al editar el usuario.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        error_log(date('[Y-m-d H:i:s] ') . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/../../../logs/error.log');
    }
    header('Location: ' . BASE_URL . 'admin/usuarios');
    exit;
}
?>