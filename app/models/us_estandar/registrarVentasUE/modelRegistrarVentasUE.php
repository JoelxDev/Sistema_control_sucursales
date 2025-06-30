<?php
require_once __DIR__ . '/../../../../config/conexion_db.php';

class RegistrarVentasUE
{
    public static function registrarVenta($tipo_venta, $id_producto, $cantidad, $precio_unitario, $total, $metodo_pago, $id_usuario_sucursal)
    {
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

            // Obtener la sucursal desde la sesión
            $id_sucursal = $_SESSION['id_sucursal'] ?? null;
            if (!$id_sucursal) {
                $db->rollBack();
                return false; // No se encontró la sucursal
            }

            // Obtener todos los registros de inventario NO completados (FIFO)
            $stmt = $db->prepare("SELECT id_inventario, cantidad_in, epoca
            FROM inventario
            WHERE productos_id_producto = :id_producto
            AND sucursal_id_sucursal = :id_sucursal
            AND completado = 'no'
            AND cantidad_in > 0
            ORDER BY epoca ASC, fecha_actualizacion ASC");
            $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            $stmt->bindParam(':id_sucursal', $id_sucursal, PDO::PARAM_INT);
            $stmt->execute();
            $inventarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Sumar el total disponible
            $total_disponible = array_sum(array_column($inventarios, 'cantidad_in'));
            if ($total_disponible < $cantidad) {
                $db->rollBack();
                return false; // No hay suficiente inventario en total
            }

            // Descontar la cantidad vendida de los registros (FIFO)
            $cantidad_restante = $cantidad;
            $id_usuario = $_SESSION['id_usuario'] ?? null;
            $motivo = 'Venta realizada';

            foreach ($inventarios as $inv) {
                if ($cantidad_restante <= 0)
                    break;
                $descontar = min($inv['cantidad_in'], $cantidad_restante);
                $nueva_cantidad = $inv['cantidad_in'] - $descontar;
                $completado = ($nueva_cantidad == 0) ? 'si' : 'no';

                // Actualiza inventario
                $stmtUpdate = $db->prepare("UPDATE inventario SET cantidad_in = :nueva_cantidad, completado = :completado, fecha_actualizacion = NOW() WHERE id_inventario = :id_inventario");
                $stmtUpdate->bindParam(':nueva_cantidad', $nueva_cantidad, PDO::PARAM_INT);
                $stmtUpdate->bindParam(':completado', $completado);
                $stmtUpdate->bindParam(':id_inventario', $inv['id_inventario'], PDO::PARAM_INT);
                $stmtUpdate->execute();

                // Registrar movimiento
                $stmtMov = $db->prepare("INSERT INTO movimientos_inventario 
                (tipo_mov, cantidad, fecha_movimento, productos_id_producto, sucursal_id_sucursal, usuarios_id_usuario, epoca, motivo)
                VALUES ('salida', :cantidad, NOW(), :id_producto, :id_sucursal, :id_usuario, :epoca, :motivo)");
                $stmtMov->bindParam(':cantidad', $descontar, PDO::PARAM_INT);
                $stmtMov->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                $stmtMov->bindParam(':id_sucursal', $id_sucursal, PDO::PARAM_INT);
                $stmtMov->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmtMov->bindParam(':epoca', $inv['epoca']);
                $stmtMov->bindParam(':motivo', $motivo);
                $stmtMov->execute();

                $cantidad_restante -= $descontar;
            }

            $db->commit();
            return true;
        } catch (PDOException $e) {
            $db->rollBack();
            error_log('Error al registrar venta: ' . $e->getMessage());
            return false;
        }
    }
    public static function obtenerVentasPorUsuario($id_usuario)
    {
        try {
            $db = Database::conectarDB();
            $stmt = $db->prepare(" SELECT 
    v.tipo_venta, 
    p.nombre_pr AS producto, 
    dv.cantidad_dv, 
    dv.precio_unitario, 
    dv.subtotal, 
    v.total, 
    v.metodo_pago, 
    v.fecha_venta,
    s.nombre_s,
    u.username
FROM ventas v
INNER JOIN usuario_sucursal us ON v.usuario_sucursal_id_usuario_sucursal = us.id_usuario_sucursal
INNER JOIN sucursal s ON us.sucursal_id_sucursal = s.id_sucursal
INNER JOIN usuarios u ON us.usuarios_id_usuario = u.id_usuario
INNER JOIN detalles_venta dv ON v.id_venta = dv.ventas_id_venta
INNER JOIN productos p ON dv.productos_id_producto = p.id_producto
WHERE us.usuarios_id_usuario = :id_usuario
ORDER BY v.fecha_venta DESC
        ");
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error al obtener ventas del usuario: ' . $e->getMessage());
            return [];
        }
    }
}
class ProductosVenta
{
    public static function obtenerTodos()
    {
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