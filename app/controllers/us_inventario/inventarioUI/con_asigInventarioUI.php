<?php
require_once __DIR__ . '/../../../models/us_inventario/inventarioUI/modelInventarioUI.php';
// session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
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
                throw new Exception("No se pudo asignar el inventario: " . $resultado['error']);
            } else {
                $_SESSION['success'] = "¡Inventario asignado correctamente! El total actualizado para hoy es: <b>{$resultado['total_cantidad_hoy']}</b>";
            }
        } else {
            throw new Exception("Por favor, completa todos los campos del formulario.");
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        error_log(date('[Y-m-d H:i:s] ') . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/../../../../logs/error.log');
    }
    header('Location: ' . BASE_URL . 'inv/inventario/asigInventario');
    exit;
}
?>