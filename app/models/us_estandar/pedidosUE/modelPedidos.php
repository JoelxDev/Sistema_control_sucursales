<?php
require_once __DIR__ . '/../../../../config/conexion_db.php';

class PedidoUE {
    private static $conexion;

    public static function getConexion() {
        if (!self::$conexion) self::$conexion = Database::conectarDB();
        return self::$conexion;
    }

    private static function logToFile(string $mensaje, string $archivo = 'pedidos.log'): void {
        $fecha = date('Y-m-d H:i:s');
        $ruta  = __DIR__ . '/../../../../logs/' . $archivo;
        if (!is_dir(dirname($ruta))) @mkdir(dirname($ruta), 0755, true);
        @file_put_contents($ruta, "[$fecha] $mensaje" . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    public static function obtenerPedidosPorSucursal(int $id_sucursal, array $filtros = []): array {
        try {
            $cn = self::getConexion();

            $sql = "SELECT 
                        p.id_pedido,
                        p.cliente_ped,
                        p.producto_ped,
                        p.detalles_ped,
                        p.fecha_pedido,
                        p.fecha_entrega,
                        p.estado_ped,
                        p.pago_adelanto,
                        p.pago_completado,
                        s.id_sucursal,
                        s.nombre_s AS nombre_sucursal,
                        CONCAT(per.nombre_p,' ',per.apellido_p) AS nombre_usuario
                    FROM pedidos p
                    INNER JOIN usuario_sucursal us ON us.id_usuario_sucursal = p.usuario_sucursal_id_usuario_sucursal
                    INNER JOIN sucursal s ON s.id_sucursal = us.sucursal_id_sucursal
                    INNER JOIN usuarios u ON u.id_usuario = us.usuarios_id_usuario
                    INNER JOIN personal per ON per.id_personal = u.personal_id_personal
                    WHERE s.id_sucursal = ?";
            $params = [$id_sucursal];

            if (!empty($filtros['estado'])) {
                $sql .= " AND p.estado_ped = ?";
                $params[] = $filtros['estado'];
            }
            if (!empty($filtros['fecha_desde'])) {
                $sql .= " AND DATE(p.fecha_pedido) >= ?";
                $params[] = $filtros['fecha_desde'];
            }
            if (!empty($filtros['fecha_hasta'])) {
                $sql .= " AND DATE(p.fecha_pedido) <= ?";
                $params[] = $filtros['fecha_hasta'];
            }

            $sql .= " ORDER BY p.fecha_pedido DESC";

            $st = $cn->prepare($sql);
            $st->execute($params);
            return $st->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            self::logToFile("obtenerPedidosPorSucursal: " . $e->getMessage(), 'error.log');
            return [];
        }
    }

    public static function crearPedido(array $datos) {
    $cn = self::getConexion();
    try {
        $cn->beginTransaction();

        if (!empty($datos['id_usuario_sucursal'])) {
            $id_usuario_sucursal = (int)$datos['id_usuario_sucursal'];
        } else {
            if (empty($datos['usuario_id']) || empty($datos['sucursal_id'])) {
                throw new Exception("Falta información de usuario o sucursal.");
            }
            $st = $cn->prepare("SELECT id_usuario_sucursal 
                                FROM usuario_sucursal
                                WHERE usuarios_id_usuario = ? AND sucursal_id_sucursal = ?
                                ORDER BY id_usuario_sucursal DESC LIMIT 1");
            $st->execute([$datos['usuario_id'], $datos['sucursal_id']]);
            $us = $st->fetch(PDO::FETCH_ASSOC);
            if (!$us) throw new Exception("Usuario no asignado a esta sucursal.");
            $id_usuario_sucursal = (int)$us['id_usuario_sucursal'];
        }

        $stI = $cn->prepare("INSERT INTO pedidos
            (cliente_ped, producto_ped, detalles_ped, cantidad_ped, fecha_pedido, fecha_entrega, estado_ped, pago_adelanto, pago_completado, usuario_sucursal_id_usuario_sucursal)
            VALUES (?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?)");
        $stI->execute([
            $datos['txtnombre_cliente'] ?? $datos['cliente_ped'] ?? '',
            $datos['txtproducto_ped'] ?? $datos['producto_ped'] ?? '',
            $datos['txtdetalles_ped'] ?? $datos['detalles_ped'] ?? $datos['txtdescripcion'] ?? '',
            (int)($datos['txtcantidad_ped'] ?? $datos['cantidad_ped'] ?? 0),
            $datos['txtfecha_entrega'] ?? $datos['fecha_entrega'] ?? '',
            $datos['txtestado_ped'] ?? $datos['estado_ped'] ?? 'pendiente',
            (float)($datos['txtpago_adelanto'] ?? $datos['pago_adelanto'] ?? 0),
            (float)($datos['txtpago_completado'] ?? $datos['pago_completado'] ?? 0),
            $id_usuario_sucursal
        ]);

        $id = (int)$cn->lastInsertId();
        $cn->commit();
        self::logToFile("Pedido creado ID=$id");
        return $id;
    } catch (Throwable $e) {
        if ($cn->inTransaction()) $cn->rollBack();
        self::logToFile("crearPedido: " . $e->getMessage(), 'error.log');
        return false;
    }
}

    public static function actualizarPedido(int $id_pedido, array $datos): bool {
        try {
            $cn = self::getConexion();
            $st = $cn->prepare("UPDATE pedidos SET 
                    cliente_ped = ?, 
                    producto_ped = ?, 
                    detalles_ped = ?, 
                    fecha_entrega = ?, 
                    estado_ped = ?, 
                    pago_adelanto = ?, 
                    pago_completado = ?
                WHERE id_pedido = ?");
            return $st->execute([
                $datos['cliente_ped'],
                $datos['producto_ped'],
                $datos['detalles_ped'],
                $datos['fecha_entrega'],
                $datos['estado_ped'],
                (float)$datos['pago_adelanto'],
                (float)$datos['pago_completado'],
                $id_pedido
            ]);
        } catch (Throwable $e) {
            self::logToFile("actualizarPedido: " . $e->getMessage(), 'error.log');
            return false;
        }
    }

    public static function actualizarEstadoPedido(int $id_pedido, string $nuevo_estado): bool {
        try {
            $cn = self::getConexion();
            $st = $cn->prepare("UPDATE pedidos SET estado_ped = ? WHERE id_pedido = ?");
            $ok = $st->execute([$nuevo_estado, $id_pedido]);
            if ($ok) self::logToFile("Pedido $id_pedido -> estado $nuevo_estado");
            return $ok;
        } catch (Throwable $e) {
            self::logToFile("actualizarEstadoPedido: " . $e->getMessage(), 'error.log');
            return false;
        }
    }

    public static function obtenerPedidoPorId(int $id_pedido): ?array {
        try {
            $cn = self::getConexion();
            $sql = "SELECT 
                        p.*,
                        s.id_sucursal,
                        s.nombre_s AS nombre_sucursal,
                        CONCAT(per.nombre_p,' ',per.apellido_p) AS nombre_usuario
                    FROM pedidos p
                    INNER JOIN usuario_sucursal us ON us.id_usuario_sucursal = p.usuario_sucursal_id_usuario_sucursal
                    INNER JOIN sucursal s ON s.id_sucursal = us.sucursal_id_sucursal
                    INNER JOIN usuarios u ON u.id_usuario = us.usuarios_id_usuario
                    INNER JOIN personal per ON per.id_personal = u.personal_id_personal
                    WHERE p.id_pedido = ?";
            $st = $cn->prepare($sql);
            $st->execute([$id_pedido]);
            $row = $st->fetch(PDO::FETCH_ASSOC);
            return $row ?: null;
        } catch (Throwable $e) {
            self::logToFile("obtenerPedidoPorId: " . $e->getMessage(), 'error.log');
            return null;
        }
    }

    public static function eliminarPedido(int $id_pedido): bool {
        try {
            $cn = self::getConexion();
            $st = $cn->prepare("DELETE FROM pedidos WHERE id_pedido = ?");
            return $st->execute([$id_pedido]);
        } catch (Throwable $e) {
            self::logToFile("eliminarPedido: " . $e->getMessage(), 'error.log');
            return false;
        }
    }

    public static function obtenerSucursalDeUsuario(int $id_usuario): ?array {
        try {
            $cn = self::getConexion();
            $sql = "SELECT 
                        s.id_sucursal,
                        s.nombre_s,
                        us.id_usuario_sucursal
                    FROM usuario_sucursal us
                    INNER JOIN sucursal s ON s.id_sucursal = us.sucursal_id_sucursal
                    WHERE us.usuarios_id_usuario = ?
                    LIMIT 1";
            $st = $cn->prepare($sql);
            $st->execute([$id_usuario]);
            $row = $st->fetch(PDO::FETCH_ASSOC);
            return $row ?: null;
        } catch (Throwable $e) {
            self::logToFile("obtenerSucursalDeUsuario: " . $e->getMessage(), 'error.log');
            return null;
        }
    }

    public static function obtenerEstadisticasPedidos(int $id_sucursal): array {
        try {
            $cn = self::getConexion();
            $sql = "SELECT 
                        COUNT(*) AS total,
                        SUM(CASE WHEN p.estado_ped = 'pendiente'  THEN 1 ELSE 0 END) AS pendientes,
                        SUM(CASE WHEN p.estado_ped = 'en_proceso' THEN 1 ELSE 0 END) AS en_proceso,
                        SUM(CASE WHEN p.estado_ped = 'completado' THEN 1 ELSE 0 END) AS completados,
                        SUM(CASE WHEN p.estado_ped = 'cancelado'  THEN 1 ELSE 0 END) AS cancelados
                    FROM pedidos p
                    INNER JOIN usuario_sucursal us ON us.id_usuario_sucursal = p.usuario_sucursal_id_usuario_sucursal
                    WHERE us.sucursal_id_sucursal = ?";
            $st = $cn->prepare($sql);
            $st->execute([$id_sucursal]);
            return $st->fetch(PDO::FETCH_ASSOC) ?: [
                'total' => 0, 'pendientes' => 0, 'en_proceso' => 0, 'completados' => 0, 'cancelados' => 0
            ];
        } catch (Throwable $e) {
            self::logToFile("obtenerEstadisticasPedidos: " . $e->getMessage(), 'error.log');
            return ['total' => 0, 'pendientes' => 0, 'en_proceso' => 0, 'completados' => 0, 'cancelados' => 0];
        }
    }
}