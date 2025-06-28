<?php
// session_start();
require_once __DIR__ . '/../../../models/us_administrador/inventario/modelInventario.php';
require_once __DIR__ . '/../../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_producto'])) {
    // Mostrar formulario de edición
    $producto = Producto::obtenerProductoPorId($_GET['id_producto']);
    if (!$producto) {
        $_SESSION['mensaje'] = "Producto no encontrado.";
        header('Location: ' . BASE_URL . 'app/views/usadministrador/inventario/btn_VProductos.php');
        exit;
    }
    include __DIR__ . '/../../../views/usadministrador/inventario/btn_EProducto.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_producto'];
    $nombre = $_POST['txtnombre_pr'];
    $descripcion = $_POST['txtdescripcion_pr'];
    $precio = $_POST['txtprecio_pr'];
    // $unidades = $_POST['txtunidades_pr'];
    $categoria = $_POST['txtcategoria_pr'];

    if (Producto::actualizar($id, $nombre, $descripcion, $precio, $categoria)) {
        $_SESSION['success'] = "Producto actualizado correctamente.";
    } else {
        $_SESSION['error'] = "Error al actualizar el producto.";
    }
    header('Location: ' . BASE_URL . 'admin/inventario/Productos');
    exit;
}
?>