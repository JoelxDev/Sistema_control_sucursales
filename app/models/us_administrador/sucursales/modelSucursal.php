<?php
require_once __DIR__ . '/../../../../config/conexion_db.php';

class Sucursal {
    public static function crear($nombre_s, $ubicacion_s, $estado_s, $ciudad_s) {
        $db = Database::conectarDB();
        $stmt = $db->prepare("INSERT INTO sucursal (nombre_s, ubicacion_s, estado_s, ciudad_s)
        VALUES (:txtnombre_s, :txtubicacion_s, :txtestado_s, :txtciudad_s)");
        $stmt->bindParam(':txtnombre_s', $nombre_s);
        $stmt->bindParam(':txtubicacion_s', $ubicacion_s);
        $stmt->bindParam(':txtestado_s', $estado_s);
        $stmt->bindParam(':txtciudad_s', $ciudad_s);
        return $stmt->execute();
    }
    public static function obtenerTodas() {
        $db = Database::conectarDB();
        $stmt = $db->prepare("SELECT * FROM sucursal");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function eliminar($id_sucursal) {
    $db = Database::conectarDB();
    // Elimina relaciones en usuario_sucursal
    $stmt1 = $db->prepare("DELETE FROM usuario_sucursal WHERE sucursal_id_sucursal = :id_sucursal");
    $stmt1->bindParam(':id_sucursal', $id_sucursal, PDO::PARAM_INT);
    $stmt1->execute();

    // Ahora elimina la sucursal
    $stmt2 = $db->prepare("DELETE FROM sucursal WHERE id_sucursal = :id_sucursal");
    $stmt2->bindParam(':id_sucursal', $id_sucursal, PDO::PARAM_INT);
    return $stmt2->execute();
}

    public static function editar($id_sucursal, $nombre_s, $ubicacion_s, $estado_s, $ciudad_s) {
        $db = Database::conectarDB();
        $stmt = $db->prepare("UPDATE sucursal SET nombre_s = :nombre_s, ubicacion_s = :ubicacion_s, estado_s = :estado_s, ciudad_s = :ciudad_s WHERE id_sucursal = :id_sucursal");
        $stmt->bindParam(':id_sucursal', $id_sucursal, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_s', $nombre_s);
        $stmt->bindParam(':ubicacion_s', $ubicacion_s);
        $stmt->bindParam(':estado_s', $estado_s);
        $stmt->bindParam(':ciudad_s', $ciudad_s);
        return $stmt->execute();
    }
    public static function obtenerPorId($id_sucursal) {
    $db = Database::conectarDB();
    $stmt = $db->prepare("SELECT * FROM sucursal WHERE id_sucursal = :id_sucursal");
    $stmt->bindParam(':id_sucursal', $id_sucursal, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}
?>