<?php
// session_start();
require_once __DIR__ . '/../../../models/us_administrador/inventario/modelInventario.php';
require_once __DIR__ . '/../../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['txtnombre_pr'] ?? '');
    $descripcion = trim($_POST['txtdescripcion_pr'] ?? '');
    $precio = trim($_POST['txtprecio_pr'] ?? '');
    $unidades = trim($_POST['txtunidades_pr'] ?? '');
    $categoria = trim($_POST['txtcategoria_pr'] ?? '');

    if (empty($nombre) || empty($descripcion) || empty($precio) || empty($unidades) || empty($categoria)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header('Location: ' . BASE_URL . 'app/views/usadministrador/inventario/btn_AProducto.php');
        exit;
    }

    if (Producto::crear($nombre, $descripcion, $precio, $unidades, $categoria)) {
        $_SESSION['success'] = "Producto creado exitosamente.";
    } else {
        $_SESSION['error'] = "Error al crear el producto.";
    }
    header('Location: ' . BASE_URL . 'admin/inventario/Producto');
    exit;
}
?>