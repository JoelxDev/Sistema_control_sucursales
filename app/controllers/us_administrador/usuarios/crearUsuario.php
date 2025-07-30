<?php
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../models/us_administrador/usuarios/modelUsuarios.php';
// Validar sesión y rol
if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header('Location: ' . BASE_URL . 'public/index.php');
    exit;
}
// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validar datos del formulario
        $nombre_p = trim($_POST['txtnombre_p'] ?? '');
        $apellido_p = trim($_POST['txtapellido_p'] ?? '');
        $dni_p = trim($_POST['txtdni_p'] ?? '');
        $telefono_p = trim($_POST['txttelefono_p'] ?? '');
        $correo_elec = trim($_POST['txtcorreo_p'] ?? '');
        $roll_p = trim($_POST['txtroll_p'] ?? '');

        if (empty($nombre_p) || empty($apellido_p) || empty($dni_p) || empty($telefono_p) || empty($roll_p)) {
            $_SESSION['error'] = "Todos los campos son obligatorios.";
            header('Location: ' . BASE_URL . 'admin/usuarios/btn_crear_us');
            exit;
        }

        // Crear usuario
        if (Usuarios::crearUsuario($nombre_p, $apellido_p, $dni_p, $telefono_p, $correo_elec, $roll_p)) {
            $_SESSION['success'] = "Usuario creadao exitosamente.";
        } else {
            $_SESSION['error'] = "Error al crear el usuario. Inténtalo nuevamente.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        error_log(date('[Y-m-d H:i:s] ') . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/../../../logs/error.log');
    }
    // Redirigir al formulario
    header('Location: ' . BASE_URL . 'admin/usuarios');
    exit;
}
?>