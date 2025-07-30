<?php
// session_start();
require_once __DIR__ . '/../../../models/us_administrador/inventario/modelInventario.php';
require_once __DIR__ . '/../../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto'])) {
    try {
        $id = intval($_POST['id_producto']);
        if (Producto::eliminar($id)) {
            $_SESSION['success'] = "Producto eliminado correctamente.";
        } else {
            $_SESSION['error'] = "Error al eliminar el producto.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        error_log(date('[Y-m-d H:i:s] ') . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/../../../logs/error.log');
    }
}
header('Location: ' . BASE_URL . 'admin/inventario/Productos');
exit;
?>