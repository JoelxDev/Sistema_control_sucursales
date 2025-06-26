<?php
require_once __DIR__ . '/../../../../config/conexion_db.php';

class ModelInventario
{
    public static function obtenerProductos()
    {
        $db = Database::conectarDB();
        $stmt = $db->query("SELECT id_producto, nombre_pr FROM productos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerSucursales()
    {
        $db = Database::conectarDB();
        $stmt = $db->query("SELECT id_sucursal, nombre_s FROM sucursal WHERE estado_s = 'activo'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
public static function asignarInventario($data)
{
    $db = Database::conectarDB();
    $hoy = date('Y-m-d');

    // 1. Verifica si ya existe el registro con misma época, producto, sucursal y fecha de hoy
    $stmt = $db->prepare("SELECT id_inventario 
        FROM inventario 
        WHERE productos_id_producto = :producto 
        AND sucursal_id_sucursal = :sucursal 
        AND epoca = :epoca 
        AND DATE(fecha_actualizacion) = :hoy");
    $stmt->bindParam(':producto', $data['producto'], PDO::PARAM_INT);
    $stmt->bindParam(':sucursal', $data['sucursal'], PDO::PARAM_INT);
    $stmt->bindParam(':epoca', $data['epoca']);
    $stmt->bindParam(':hoy', $hoy);
    $stmt->execute();
    $inventarioHoy = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($inventarioHoy) {
        // Error: ya existe asignación para esta época hoy
        return ['success' => false, 'error' => 'Ya existe una asignación para esta época hoy.'];
    }

    // 2. Inserta nuevo registro para la época (no suma aquí, solo inserta)
    $stmtInsert = $db->prepare("INSERT INTO inventario (cantidad_in, fecha_actualizacion, productos_id_producto, sucursal_id_sucursal, epoca, completado)
        VALUES (:cantidad, NOW(), :producto, :sucursal, :epoca, 'no')");
    $stmtInsert->bindParam(':cantidad', $data['cantidad'], PDO::PARAM_INT);
    $stmtInsert->bindParam(':producto', $data['producto'], PDO::PARAM_INT);
    $stmtInsert->bindParam(':sucursal', $data['sucursal'], PDO::PARAM_INT);
    $stmtInsert->bindParam(':epoca', $data['epoca']);
    $stmtInsert->execute();

    // 3. Suma total de cantidades para ese producto, sucursal y fecha de hoy (todas las épocas)
    $stmtSum = $db->prepare("SELECT SUM(cantidad_in) as total_cantidad
        FROM inventario
        WHERE productos_id_producto = :producto
        AND sucursal_id_sucursal = :sucursal
        AND DATE(fecha_actualizacion) = :hoy");
    $stmtSum->bindParam(':producto', $data['producto'], PDO::PARAM_INT);
    $stmtSum->bindParam(':sucursal', $data['sucursal'], PDO::PARAM_INT);
    $stmtSum->bindParam(':hoy', $hoy);
    $stmtSum->execute();
    $suma = $stmtSum->fetch(PDO::FETCH_ASSOC);

    // Registrar el movimiento
    $tipo_mov = strpos(strtolower($data['tipo_asig']), 'entrada') !== false ? 'entrada' : 'salida';
    $motivo = 'asignación manual';

    $stmt3 = $db->prepare("INSERT INTO movimientos_inventario (tipo_mov, cantidad, fecha_movimento, productos_id_producto, sucursal_id_sucursal, usuarios_id_usuario, epoca, motivo, ventas_id_venta)
        VALUES (:tipo_mov, :cantidad, NOW(), :producto, :sucursal, :usuario, :epoca, :motivo, :id_venta)");
    $stmt3->bindParam(':tipo_mov', $tipo_mov);
    $stmt3->bindParam(':cantidad', $data['cantidad'], PDO::PARAM_INT);
    $stmt3->bindParam(':producto', $data['producto'], PDO::PARAM_INT);
    $stmt3->bindParam(':sucursal', $data['sucursal'], PDO::PARAM_INT);
    $stmt3->bindParam(':usuario', $data['usuario'], PDO::PARAM_INT);
    $stmt3->bindParam(':epoca', $data['epoca']);
    $stmt3->bindParam(':motivo', $motivo);
    $stmt3->bindParam(':id_venta', $id_venta, PDO::PARAM_INT); // <-- ID de la venta
    $stmt3->execute();

    // Devuelve la suma total de cantidades para mostrar si lo necesitas
    return [
        'success' => true,
        'total_cantidad_hoy' => $suma['total_cantidad']
    ];
}

}