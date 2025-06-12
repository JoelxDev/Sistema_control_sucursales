<?php
require_once __DIR__ . '/../../../../config/conexion_db.php';

class RegistrarVentasUE {
    public static function registrarVenta($tipo_venta, $id_producto, $cantidad, $precio_unitario, $total, $metodo_pago, $id_usuario_sucursal) {
        try {
            $db = Database::conectarDB();
            $db->beginTransaction();

            // Insertar venta
            $stmt = $db->prepare("INSERT INTO ventas (tipo_venta, fecha_venta, total, metodo_pago, usuario_sucursal_id_usuario_sucursal) VALUES (:tipo_venta, NOW(), :total, :metodo_pago, :usuario_sucursal)");
            $stmt->bindParam(':tipo_venta', $tipo_venta);
            $stmt->bindParam(':total', $total);
            $stmt->bindParam(':metodo_pago', $metodo_pago);
            $stmt->bindParam(':usuario_sucursal', $id_usuario_sucursal);
            $stmt->execute();
            $id_venta = $db->lastInsertId();

            // Insertar detalle de venta
            $stmt = $db->prepare("INSERT INTO detalles_venta (cantidad_dv, precio_unitario, subtotal, ventas_id_venta, productos_id_producto) VALUES (:cantidad, :precio_unitario, :subtotal, :id_venta, :id_producto)");
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':precio_unitario', $precio_unitario);
            $stmt->bindParam(':subtotal', $total);
            $stmt->bindParam(':id_venta', $id_venta);
            $stmt->bindParam(':id_producto', $id_producto);
            $stmt->execute();

            $db->commit();
            return true;
        } catch (PDOException $e) {
            $db->rollBack();
            error_log('Error al registrar venta: ' . $e->getMessage());
            return false;
        }
    }
}

class Producto {
    public static function obtenerTodos() {
        try {
            $db = Database::conectarDB();
            // 
            $stmt = $db->query("SELECT * FROM productos");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error al obtener productos: ' . $e->getMessage());
            return [];
        }
    }
}

?>