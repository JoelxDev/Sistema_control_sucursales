<?php
require_once __DIR__ . '/../../../models/us_administrador/informacion/informacionUsuarios.php';

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

try {
    $id_usuario = $_SESSION['id_usuario'] ?? null;
    if (!$id_usuario) {
        throw new Exception('No hay sesión activa.');
    }
    $usuario = informacionUsuario::obtenerPorId($id_usuario);
    if (!$usuario) {
        throw new Exception('Usuario no encontrado.');
    }
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>