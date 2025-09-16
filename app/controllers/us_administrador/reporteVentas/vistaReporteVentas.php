<?php
require_once __DIR__ . '/../../../models/us_administrador/reporte-ventas/modelReVentas.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
try {
    $id_usuario = $_SESSION['id_usuario'] ?? null;
    if (!$id_usuario) {
        throw new Exception('No hay sesión activa del usuario.');
    }
    $ventas = Ventas::obtenerVentas();
    $sucursalesActivas = Ventas::obtenerSucursalesActivas();
    if (!$ventas) {
        throw new Exception('Usuario no encontrada.');
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    error_log(date('[Y-m-d H:i:s] ') . $error . PHP_EOL, 3, __DIR__ . '/../../../../logs/error.log');
}
?>