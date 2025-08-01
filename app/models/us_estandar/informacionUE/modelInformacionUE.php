<?php
require_once __DIR__ . '/../../../../config/conexion_db.php';
class informacionUsuario
{
    public static function obtenerPorId($id)
    {
        try {
            $db = Database::conectarDB();
            $stmt = $db->prepare("SELECT personal.nombre_p, personal.apellido_p, personal.telefono_p, usuarios.id_usuario, usuarios.username
        FROM personal
        INNER JOIN usuarios ON personal.id_personal = usuarios.personal_id_personal
        WHERE usuarios.id_usuario= :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }  catch(PDOException $e) {
            error_log(date('[Y-m-d H:i:s] ') . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/../../../logs/error.log');
            return [];
        }
    }
}
?>