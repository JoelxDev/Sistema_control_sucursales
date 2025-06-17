<?php
// session_start();
require_once __DIR__ . '/../../../models/us_administrador/inventario/modelInventario.php';
require_once __DIR__ . '/../../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto'])) {
    $id = intval($_POST['id_producto']);
    if (Producto::eliminar($id)) {
        $_SESSION['mensaje'] = "Producto eliminado correctamente.";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar el producto.";
    }
}
header('Location: ' . BASE_URL . 'admin/inventario/Productos');
exit;
?>