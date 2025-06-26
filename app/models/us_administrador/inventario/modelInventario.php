<?php
require_once __DIR__ . '/../../../../config/conexion_db.php';

class Producto
{
    public static function crear($nombre, $descripcion, $precio, $unidades, $categoria)
    {
        try {
            $db = Database::conectarDB();
            $stmt = $db->prepare("INSERT INTO productos (nombre_pr, descripcion_pr, precio_unitario_pr, stock, categoria)
                VALUES (:nombre, :descripcion, :precio, :unidades, :categoria)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':unidades', $unidades);
            $stmt->bindParam(':categoria', $categoria);
            if ($stmt->execute()) {
                return true;
            } else {
                // Puedes registrar el error usando $stmt->errorInfo()
                error_log('Error al insertar producto: ' . implode(' | ', $stmt->errorInfo()));
                return false;
            }
        } catch (PDOException $e) {
            // Registrar el error para depuración
            error_log('Excepción PDO al crear producto: ' . $e->getMessage());
            return false;
        }
    }
    public static function obtenerTodos()
    {
        try {
            $db = Database::conectarDB();
            $stmt = $db->query("SELECT * FROM productos");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error al obtener productos: ' . $e->getMessage());
            return [];
        }
    }

    public static function eliminar($id_producto)
    {
        try {
            $db = Database::conectarDB();
            $stmt = $db->prepare("DELETE FROM productos WHERE id_producto = :id");
            $stmt->bindParam(':id', $id_producto, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Error al eliminar producto: ' . $e->getMessage());
            return false;
        }
    }
    public static function obtenerProductoPorId($id_producto)
    {
        try {
            $db = Database::conectarDB();
            $stmt = $db->prepare("SELECT * FROM productos WHERE id_producto = :id");
            $stmt->bindParam(':id', $id_producto, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error al obtener producto por ID: ' . $e->getMessage());
            return false;
        }
    }

    public static function actualizar($id_producto, $nombre, $descripcion, $precio, $categoria)
    {
        try {
            $db = Database::conectarDB();
            $stmt = $db->prepare("UPDATE productos SET nombre_pr = :nombre, descripcion_pr = :descripcion, precio_unitario_pr = :precio, categoria = :categoria WHERE id_producto = :id");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio', $precio);
            // $stmt->bindParam(':unidades', $unidades);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':id', $id_producto, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Error al actualizar producto: ' . $e->getMessage());
            return false;
        }
    }
    public static function obtenerInventarioPorSucursal()
    {
        try {
            $db = Database::conectarDB();
            $stmt = $db->query(
                "SELECT 
                s.id_sucursal,
                s.nombre_s AS sucursal,
                p.id_producto,
                p.nombre_pr AS producto,
                SUM(i.cantidad_in) AS cantidad_total,
                MAX(i.fecha_actualizacion) AS ultima_actualizacion,
                (
                    SELECT epoca 
                    FROM inventario 
                    WHERE productos_id_producto = i.productos_id_producto 
                    AND sucursal_id_sucursal = i.sucursal_id_sucursal 
                    ORDER BY fecha_actualizacion DESC 
                    LIMIT 1
                ) AS epoca
            FROM inventario i
            JOIN sucursal s ON i.sucursal_id_sucursal = s.id_sucursal
            JOIN productos p ON i.productos_id_producto = p.id_producto
            GROUP BY s.id_sucursal, p.id_producto
            ORDER BY s.nombre_s, p.nombre_pr");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error al obtener inventario por sucursal: ' . $e->getMessage());
            return [];
        }
    }
}
?>