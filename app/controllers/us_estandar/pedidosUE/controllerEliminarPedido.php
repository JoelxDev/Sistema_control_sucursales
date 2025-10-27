<?php
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../models/us_estandar/pedidosUE/modelPedidos.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . 'usuario/pedidos/listaPedidos');
    exit;
}

$id = (int)($_POST['id_pedido'] ?? 0);
if ($id <= 0) {
    $_SESSION['error'] = 'ID inválido';
    header('Location: ' . BASE_URL . 'usuario/pedidos/listaPedidos');
    exit;
}

if (PedidoUE::eliminarPedido($id)) {
    $_SESSION['success'] = "Pedido #$id eliminado.";
} else {
    $_SESSION['error'] = "No se pudo eliminar el pedido.";
}
header('Location: ' . BASE_URL . 'usuario/pedidos/listaPedidos');
exit;