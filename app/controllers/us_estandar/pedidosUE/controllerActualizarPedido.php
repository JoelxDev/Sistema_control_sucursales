<?php
// ...existing code...
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../models/us_estandar/pedidosUE/modelPedidos.php';

$id_usuario = (int)($_SESSION['id_usuario'] ?? 0);
if ($id_usuario <= 0) {
    header('Location: ' . BASE_URL);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar actualización
    $id = (int)($_POST['id_pedido'] ?? 0);
    if ($id <= 0) {
        $_SESSION['error'] = 'ID de pedido inválido';
        header('Location: ' . BASE_URL . 'usuario/pedidos/listaPedidos');
        exit;
    }

    $datos = [
        'cliente_ped'     => trim($_POST['cliente_ped'] ?? ''),
        'producto_ped'    => trim($_POST['producto_ped'] ?? ''),
        'detalles_ped'    => trim($_POST['detalles_ped'] ?? ''),
        'fecha_entrega'   => $_POST['fecha_entrega'] ?? '',
        'estado_ped'      => $_POST['estado_ped'] ?? 'pendiente',
        'pago_adelanto'   => is_numeric($_POST['pago_adelanto'] ?? null) ? (float)$_POST['pago_adelanto'] : 0.0,
        'pago_completado' => is_numeric($_POST['pago_completado'] ?? null) ? (float)$_POST['pago_completado'] : 0.0,
    ];

    if ($datos['cliente_ped'] === '' || $datos['producto_ped'] === '') {
        $_SESSION['error'] = 'Cliente y producto son obligatorios';
        header('Location: ' . BASE_URL . 'usuario/pedidos/editar?id=' . $id);
        exit;
    }

    if (PedidoUE::actualizarPedido($id, $datos)) {
        $_SESSION['success'] = "Pedido #$id actualizado.";
    } else {
        $_SESSION['error'] = "No se pudo actualizar el pedido.";
    }
    header('Location: ' . BASE_URL . 'usuario/pedidos/listaPedidos');
    exit;
}

// GET -> cargar datos para mostrar en el formulario
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    $_SESSION['error'] = 'ID inválido';
    header('Location: ' . BASE_URL . 'usuario/pedidos/listaPedidos');
    exit;
}

$pedido = PedidoUE::obtenerPedidoPorId($id);
if (!$pedido) {
    $_SESSION['error'] = 'Pedido no encontrado';
    header('Location: ' . BASE_URL . 'usuario/pedidos/listaPedidos');
    exit;
}
// ...existing code...
?>