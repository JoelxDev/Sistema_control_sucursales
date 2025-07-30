<?php
require_once __DIR__ . '/../../../models/us_estandar/registrarVentasUE/modelRegistrarVentasUE.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$id_usuario = $_SESSION['id_usuario'] ?? null;
$ventas = [];
if ($id_usuario) {
}
try {
    $id_usuario = $_SESSION['id_usuario'] ?? null;
    if (!$id_usuario) {
        throw new Exception('No hay sesión activa del usuario.');
    }
    $ventas = RegistrarVentasUE::obtenerVentasPorUsuario($id_usuario);
    if (!$ventas) {
        throw new Exception('Venta no encontrada.');
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    error_log(date('[Y-m-d H:i:s] ') . $error . PHP_EOL, 3, __DIR__ . '/../../../../logs/error.log');
}
?>