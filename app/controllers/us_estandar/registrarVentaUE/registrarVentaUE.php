<?php
// session_start();
require_once __DIR__ . '/../../../models/us_estandar/registrarVentasUE/modelRegistrarVentasUE.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo_venta = $_POST['txttipo_venta'];
    $id_producto = $_POST['txtnom_producto'];
    $cantidad = $_POST['txtcantidad'];
    $precio_unitario = $_POST['txtprecio_unitario'];
    $total = $_POST['txttotal'];
    $metodo_pago = $_POST['txtmetodo_pago'];

    // Obtener el id_usuario_sucursal correcto
    $db = Database::conectarDB();
    $stmt = $db->prepare("SELECT id_usuario_sucursal FROM usuario_sucursal WHERE usuarios_id_usuario = :usuario AND sucursal_id_sucursal = :sucursal ORDER BY id_usuario_sucursal DESC LIMIT 1");
    $stmt->bindParam(':usuario', $_SESSION['id_usuario'], PDO::PARAM_INT);
    $stmt->bindParam(':sucursal', $_SESSION['id_sucursal'], PDO::PARAM_INT);
    $stmt->execute();
    $id_usuario_sucursal = $stmt->fetchColumn();

    if (!$id_usuario_sucursal) {
        $_SESSION['mensaje'] = "No se pudo identificar la sesión de usuario en sucursal.";
        header('Location: ../../views/us_estandar/registrarVentasUE/registrarVentasUE.php');
        exit;
    }
    // var_dump($tipo_venta, $id_producto, $cantidad, $precio_unitario, $total, $metodo_pago, $id_usuario_sucursal);
    // exit;
    // Llama a tu modelo para registrar la venta
    $resultado = RegistrarVentasUE::registrarVenta($tipo_venta, $id_producto, $cantidad, $precio_unitario, $total, $metodo_pago, $id_usuario_sucursal);

    if ($resultado) {
        $_SESSION['success'] = "Venta registrada correctamente.";
    } else {
        $_SESSION['error'] = "Error al registrar la venta.";
    }
    header('Location:' . BASE_URL . 'usuario/ventas');
    exit;
}
?>