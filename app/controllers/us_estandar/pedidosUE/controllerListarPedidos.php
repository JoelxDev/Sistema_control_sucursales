<?php
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../models/us_estandar/pedidosUE/modelPedidos.php';
require_once __DIR__ . '/../../../models/us_administrador/sucursales/modelSucursal.php';

$id_usuario = (int)($_SESSION['id_usuario'] ?? 0);
if ($id_usuario <= 0) {
    header('Location: ' . BASE_URL);
    exit;
}

// Preferir la sucursal fijada en sesión (se establece en el login)
if (!empty($_SESSION['id_sucursal'])) {
    $sucursal_usuario = [
        'id_sucursal' => (int)$_SESSION['id_sucursal'],
        'nombre_s'    => $_SESSION['nombre_sucursal'] ?? null,
        'id_usuario_sucursal' => isset($_SESSION['id_usuario_sucursal']) ? (int)$_SESSION['id_usuario_sucursal'] : null
    ];

    // Si no tenemos el nombre de la sucursal en sesión, buscarlo en el modelo Sucursal
    if (empty($sucursal_usuario['nombre_s'])) {
        $s_row = Sucursal::obtenerPorId($sucursal_usuario['id_sucursal'] ?? 0);
        if ($s_row) $sucursal_usuario['nombre_s'] = $s_row['nombre_s'] ?? '';
    }
} else {
    // fallback: obtener la relación más reciente desde el modelo
    $sucursal_usuario = PedidoUE::obtenerSucursalDeUsuario($id_usuario);
}

// si aún no hay sucursal -> error
if (!$sucursal_usuario) {
    error_log("[pedidos] usuario {$id_usuario} sin sucursal asignada\n", 3, __DIR__ . '/../../../../logs/pedidos.log');
    $_SESSION['error'] = 'Usuario no asignado a ninguna sucursal';
    header('Location: ' . BASE_URL . 'usuario/pedidos');
    exit;
}

// filtros desde GET
$filtros = [
    'estado'      => $_GET['estado'] ?? '',
    'fecha_desde' => $_GET['fecha_desde'] ?? '',
    'fecha_hasta' => $_GET['fecha_hasta'] ?? ''
];

// obtener pedidos y estadísticas
$pedidos = PedidoUE::obtenerPedidosPorSucursal((int)$sucursal_usuario['id_sucursal'], $filtros);
$estadisticas = PedidoUE::obtenerEstadisticasPedidos((int)$sucursal_usuario['id_sucursal']);

// debug corto: log de conteo
error_log("[pedidos] usuario {$id_usuario} sucursal {$sucursal_usuario['id_sucursal']} pedidos=" . count($pedidos) . "\n", 3, __DIR__ . '/../../../../logs/pedidos.log');
?>