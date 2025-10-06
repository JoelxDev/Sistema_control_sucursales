<?php
require_once __DIR__ . '/../../../../config/conexion_db.php';

class ModelInventarioUE
{
    public static function obtenerInventarioSucursal($id_sucursal)
    {
        try {
            $db = Database::conectarDB();
            $sql = "
                SELECT
                    p.id_producto,
                    p.nombre_pr,
                    p.precio_unitario_pr,
                    p.descripcion_pr,
                    p.categoria,
                    SUM(i.cantidad_in) AS cantidad_total,
                    MAX(i.fecha_actualizacion) AS ultima_actualizacion,
                    s.id_sucursal,
                    s.nombre_s AS sucursal
                FROM inventario i
                JOIN productos p ON i.productos_id_producto = p.id_producto
                JOIN sucursal s ON i.sucursal_id_sucursal = s.id_sucursal
                WHERE s.id_sucursal = :id_sucursal
                GROUP BY p.id_producto, p.nombre_pr, p.precio_unitario_pr, p.descripcion_pr, p.categoria, s.id_sucursal, s.nombre_s
                ORDER BY p.nombre_pr
            ";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_sucursal', $id_sucursal, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error ModelInventarioUE::obtenerInventarioSucursal: ' . $e->getMessage());
            return [];
        }
    }
}