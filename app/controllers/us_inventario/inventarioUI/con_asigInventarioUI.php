<?php
require_once __DIR__ . '/../../../models/us_inventario/inventarioUI/modelInventarioUI.php';
// session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo_asig = $_POST['txttipoasigInv'] ?? '';
    $epoca = $_POST['txtepocaInv'] ?? '';
    $producto = $_POST['txtproductoInv'] ?? '';
    $sucursal = $_POST['txtsucursalInv'] ?? '';
    $cantidad = $_POST['txtcantidadInv'] ?? '';
    $id_usuario = $_SESSION['id_usuario'] ?? null;

    // Validación básica
    if ($tipo_asig && $epoca && $producto && $sucursal && $cantidad && $id_usuario) {
        // Llama al modelo para registrar la asignación
        $resultado = ModelInventario::asignarInventario([
            'tipo_asig' => $tipo_asig,
            'epoca' => $epoca,
            'producto' => $producto,
            'sucursal' => $sucursal,
            'cantidad' => $cantidad,
            'usuario' => $id_usuario
        ]);
        if (!$resultado['success']) {
            $_SESSION['error'] = "No se pudo asignar el inventario: " . $resultado['error'];
        } else {
            $_SESSION['success'] = "¡Inventario asignado correctamente! El total actualizado para hoy es: <b>{$resultado['total_cantidad_hoy']}</b>";
        }
        header('Location: ' . BASE_URL . 'inv/inventario/asigInventario');
        exit;
    } else {
        $_SESSION['error'] = "Por favor, completa todos los campos del formulario.";
        header('Location: ' . BASE_URL . 'inv/inventario/asigInventario');
        exit;
    }
}
?>