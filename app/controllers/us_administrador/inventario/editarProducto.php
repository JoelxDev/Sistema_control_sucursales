<?php
// session_start();
require_once __DIR__ . '/../../../models/us_administrador/inventario/modelInventario.php';
require_once __DIR__ . '/../../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_producto'])) {
    // Mostrar formulario de edición
    try {
        $producto = Producto::obtenerProductoPorId($_GET['id_producto']);
        if (!$producto) {
            $_SESSION['error'] = "Producto no encontrado.";
            header('Location: ' . BASE_URL . 'app/views/usadministrador/inventario/btn_VProductos.php');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        error_log(date('[Y-m-d H:i:s] ') . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/../../../logs/error.log');
    }
    include __DIR__ . '/../../../views/usadministrador/inventario/btn_EProducto.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = $_POST['id_producto'];
        $nombre = $_POST['txtnombre_pr'];
        $descripcion = $_POST['txtdescripcion_pr'];
        $precio = $_POST['txtprecio_pr'];
        // $unidades = $_POST['txtunidades_pr'];
        $categoria = $_POST['txtcategoria_pr'];
        if (empty($nombre) || empty($descripcion) || empty($precio) || empty($categoria)) {
            throw new Exception("Todos los campos son obligatorios.");
        }
        if (Producto::actualizar($id, $nombre, $descripcion, $precio, $categoria)) {
            $_SESSION['success'] = "Producto actualizado correctamente.";
        } else {
            $_SESSION['error'] = "Error al actualizar el producto.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        error_log(date('[Y-m-d H:i:s] ') . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/../../../logs/error.log');
    }
    header('Location: ' . BASE_URL . 'admin/inventario/Productos');
    exit;
}
?>