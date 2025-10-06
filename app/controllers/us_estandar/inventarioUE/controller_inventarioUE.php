<?php
// session_start();
require_once __DIR__ . '/../../../models/us_estandar/inventarioUE/modelInventarioUE.php';

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

try {
    $id_sucursal = $_SESSION['id_sucursal'] ?? null;
    if (!$id_sucursal) {
        throw new Exception('No hay sucursal activa en la sesión.');
    }
    $inventario = ModelInventarioUE::obtenerInventarioSucursal($id_sucursal);
    if (!$inventario) {
        throw new Exception('No se encontró inventario para la sucursal.');
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    error_log(date('[Y-m-d H:i:s] ') . $error . PHP_EOL, 3, __DIR__ . '/../../../../logs/error.log');
    $inventario = [];
}