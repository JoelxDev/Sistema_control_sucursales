<?php
require_once __DIR__ . '/../../../models/us_administrador/inventario/modelInventario.php';
$movimientos = Producto::obtenerMovimientosInventario();
// include __DIR__ . '/../../../views/usadministrador/inventario/btn_MInventario.php';