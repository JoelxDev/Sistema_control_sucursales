<?php
require_once __DIR__ . '/../../../models/us_inventario/modPedidos/modelPedidosUI.php';

try{
    $pedidos = ModPedidos::obtenerPedidosPendientesYEntregados();
    $todosPedidos = ModPedidos::obtenerTodosLosPedidos();
}catch (Exception $e) {
    $error = $e->getMessage();
    error_log(date('[Y-m-d H:i:s] ') . $error . PHP_EOL, 3, __DIR__ . '/../../../../logs/error.log');
}