<?php
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../models/us_estandar/pedidosUE/modelPedidos.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id_usuario = (int)$_SESSION['id_usuario'];
        if (!$id_usuario) throw new Exception('Sesión inválida');

        // preferir la sucursal/relación fijada en sesión (se estableció en el login)
        $sucursal_id = isset($_SESSION['id_sucursal']) ? (int)$_SESSION['id_sucursal'] : null;
        $id_usuario_sucursal = isset($_SESSION['id_usuario_sucursal']) ? (int)$_SESSION['id_usuario_sucursal'] : null;

        // Datos POST
        $cliente_ped   = trim($_POST['txtnombre_cliente']   ?? '');
        $producto_ped  = trim($_POST['txtnombre_producto']  ?? '');
        $detalles_ped  = trim($_POST['txtdescripcion']  ?? '');
        $cantidad_ped  = is_numeric($_POST['txtcantidad_ped']  ?? null) ? (int)$_POST['txtcantidad_ped'] : 0;
        $fecha_entrega = $_POST['txtfecha_entrega'] ?? '';
        $pago_adelanto = is_numeric($_POST['txtpago_adelanto'] ?? null) ? (float)$_POST['txtpago_adelanto'] : 0;
        $pago_completado = is_numeric($_POST['txtpago_completado'] ?? null) ? (float)$_POST['txtpago_completado'] : 0;
        $estado_ped    = $_POST['txtestado'] ?? 'pendiente';

        if ($cliente_ped === '' || $producto_ped === '') throw new Exception("Cliente y producto son obligatorios");
        if (!$fecha_entrega) throw new Exception("La fecha de entrega es obligatoria");

        $payload = [    
            'usuario_id'       => $id_usuario,
            'sucursal_id'      => $sucursal_id,
            'txtnombre_cliente'   => $cliente_ped,
            'txtproducto_ped'     => $producto_ped,
            'txtdetalles_ped'     => $detalles_ped,
            'txtcantidad_ped'     => $cantidad_ped,
            'txtfecha_entrega'    => $fecha_entrega,
            'txtpago_adelanto'    => $pago_adelanto,
            'txtpago_completado'  => $pago_completado,
            'txtestado_ped'       => $estado_ped
        ];

        if ($id_usuario_sucursal) $payload['id_usuario_sucursal'] = $id_usuario_sucursal;

        $id = PedidoUE::crearPedido($payload);

        if ($id) {
             $_SESSION['success'] = "Pedido #$id registrado.";
             header('Location: ' . BASE_URL . 'usuario/pedidos/listaPedidos');
         } else {
             throw new Exception("No se pudo registrar el pedido");
         }
    } catch (Throwable $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ' . BASE_URL . 'usuario/pedidos');
    }
    exit;
}