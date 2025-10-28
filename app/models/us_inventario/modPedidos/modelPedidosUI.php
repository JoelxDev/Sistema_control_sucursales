<?php
require_once __DIR__ . '/../../../../config/conexion_db.php';

class ModPedidos {
    private static $cn;

    public static function getConexion() {
        if (!self::$cn) self::$cn = Database::conectarDB();
        return self::$cn;
    }

    public static function obtenerPedidosPendientesYEntregados(): array {
        try {
            $cn = self::getConexion();
            $sql = "SELECT 
                        p.id_pedido,
                        p.cliente_ped,
                        p.producto_ped,
                        COALESCE(p.cantidad_ped, '') AS cantidad_ped,
                        p.detalles_ped,
                        p.pago_adelanto,
                        p.pago_completado,
                        p.fecha_pedido,
                        p.fecha_entrega,
                        p.estado_ped,
                        s.nombre_s AS sucursal,
                        CONCAT(per.nombre_p,' ',per.apellido_p) AS personal
                    FROM pedidos p
                    INNER JOIN usuario_sucursal us ON us.id_usuario_sucursal = p.usuario_sucursal_id_usuario_sucursal
                    INNER JOIN sucursal s ON s.id_sucursal = us.sucursal_id_sucursal
                    INNER JOIN usuarios u ON u.id_usuario = us.usuarios_id_usuario
                    LEFT JOIN personal per ON per.id_personal = u.personal_id_personal
                    WHERE p.estado_ped IN ('pendiente','entregado')
                    ORDER BY p.fecha_pedido DESC";
            $st = $cn->prepare($sql);
            $st->execute();
            return $st->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            error_log("ModPedidos::obtenerPedidosPendientesYEntregados: " . $e->getMessage() . "\n", 3, __DIR__ . '/../../../../logs/pedidos.log');
            return [];
        }
    }

    public static function obtenerTodosLosPedidos(): array {
        try {
            $cn = self::getConexion();
            $sql = "SELECT 
                        p.id_pedido,
                        p.cliente_ped,
                        p.producto_ped,
                        COALESCE(p.cantidad_ped, '') AS cantidad_ped,
                        p.detalles_ped,
                        p.pago_adelanto,
                        p.pago_completado,
                        p.fecha_pedido,
                        p.fecha_entrega,
                        p.estado_ped,
                        s.nombre_s AS sucursal,
                        CONCAT(per.nombre_p,' ',per.apellido_p) AS personal
                    FROM pedidos p
                    INNER JOIN usuario_sucursal us ON us.id_usuario_sucursal = p.usuario_sucursal_id_usuario_sucursal
                    INNER JOIN sucursal s ON s.id_sucursal = us.sucursal_id_sucursal
                    INNER JOIN usuarios u ON u.id_usuario = us.usuarios_id_usuario
                    LEFT JOIN personal per ON per.id_personal = u.personal_id_personal
                    -- Sin filtro de estado para devolver todos los pedidos
                    ORDER BY p.fecha_pedido DESC";
            $st = $cn->prepare($sql);
            $st->execute();
            return $st->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            error_log("ModPedidos::obtenerPedidosPendientesYEntregados: " . $e->getMessage() . "\n", 3, __DIR__ . '/../../../../logs/pedidos.log');
            return [];
            }
    }
}