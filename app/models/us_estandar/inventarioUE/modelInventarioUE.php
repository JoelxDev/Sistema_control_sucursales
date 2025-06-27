<?php
require_once __DIR__ . '/../../../../config/conexion_db.php';

class ModelInventarioUE {
    public static function obtenerInventarioSucursal($id_sucursal) {
        $db = Database::conectarDB();
        $stmt = $db->prepare(" SELECT p.id_producto, p.nombre_pr, SUM(i.cantidad_in) AS cantidad_total
            FROM productos p
            INNER JOIN inventario i ON i.productos_id_producto = p.id_producto
            WHERE i.sucursal_id_sucursal = :id_sucursal
            AND i.completado = 'no'
            GROUP BY p.id_producto, p.nombre_pr
        ");
        $stmt->bindParam(':id_sucursal', $id_sucursal, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}