<?php
require_once __DIR__ . '/../../../models/us_inventario/inventarioUI/modelInventarioUI.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

// Obtener todas las asignaciones de inventario
$historial = ModelInventario::obtenerHistorialAsignaciones();
?>