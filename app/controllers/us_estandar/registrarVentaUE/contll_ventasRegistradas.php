<?php
require_once __DIR__ . '/../../../models/us_estandar/registrarVentasUE/modelRegistrarVentasUE.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$id_usuario = $_SESSION['id_usuario'] ?? null;
$ventas = [];
if ($id_usuario) {
    $ventas = RegistrarVentasUE::obtenerVentasPorUsuario($id_usuario);
}
?>