<?php
// session_start();
require_once __DIR__ . '/../../../models/us_estandar/inventarioUE/modelInventarioUE.php';

$id_sucursal = $_SESSION['id_sucursal'] ?? null;
$inventario = [];
if ($id_sucursal) {
    $inventario = ModelInventarioUE::obtenerInventarioSucursal($id_sucursal);
}

// Luego incluye la vista y pásale $inventario
// include __DIR__ . '/../../../views/usestandar/inventarioUE/inventarioUE.php';aa