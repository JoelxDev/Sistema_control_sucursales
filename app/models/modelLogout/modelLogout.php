<?php
require_once __DIR__ . '/../../../config/conexion_db.php';

class ModelUsuarioSucursal {
    public static function registrarSalida($id_usuario, $id_sucursal) {
        $db = Database::conectarDB();
        $hora_salida = date('H:i:s');
        $stmt = $db->prepare("UPDATE usuario_sucursal 
        SET hora_salida = :hora_salida 
        WHERE usuarios_id_usuario = :usuario AND sucursal_id_sucursal = :sucursal ORDER BY id_usuario_sucursal DESC LIMIT 1");
        $stmt->bindParam(':hora_salida', $hora_salida);
        $stmt->bindParam(':usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':sucursal', $id_sucursal, PDO::PARAM_INT);
        $stmt->execute();
    }
}