<?php
require_once __DIR__ . '/../../../../config/conexion_db.php';
require_once __DIR__ . '/../../../../config/config.php';

class Ventas
{
    public static function obtenerVentas()
    {
        try {
            $db = Database::conectarDB();
            $sql = "SELECT 
        v.id_venta AS id_venta, 
                    dv.cantidad_dv AS cantidad,
                    p.nombre_pr AS nombre_producto,
                    per.nombre_p AS nombre_vendedor,
                    per.apellido_p AS apellido_vendedor,
                    s.nombre_s AS sucursal,
                    v.total AS total_venta,
                    v.tipo_venta,
                    v.metodo_pago AS tipo_pago,
                    v.fecha_venta
                FROM ventas v
                INNER JOIN detalles_venta dv ON v.id_venta = dv.ventas_id_venta
                INNER JOIN productos p ON dv.productos_id_producto = p.id_producto
                INNER JOIN usuario_sucursal us ON v.usuario_sucursal_id_usuario_sucursal = us.id_usuario_sucursal
                INNER JOIN usuarios u ON us.usuarios_id_usuario = u.id_usuario
                INNER JOIN personal per ON u.personal_id_personal = per.id_personal
                INNER JOIN sucursal s ON us.sucursal_id_sucursal = s.id_sucursal
                ORDER BY v.fecha_venta DESC";

            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log(date('[Y-m-d H:i:s] ') . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/../../../logs/error.log');
            return [];
        }
    }
}
?>