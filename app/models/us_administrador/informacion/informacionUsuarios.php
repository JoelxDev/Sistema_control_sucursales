<?php 
require_once __DIR__ . '/../../../../config/conexion_db.php';


class informacionUsuario{
    public static function obtenerPorId($id){
        try {
            $db = Database::conectarDB();
            $stmt = $db->prepare("SELECT personal.nombre_p, personal.apellido_p, personal.telefono_p, usuarios.id_usuario, usuarios.username
            FROM personal
            INNER JOIN usuarios ON personal.id_personal = usuarios.personal_id_personal
            WHERE usuarios.id_usuario = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error al obtener información del usuario: ' . $e->getMessage());
            return null;
        }
    }

    // public static function obtenerInformacionUsuario(){
    //     try {
    //         $db = Database::conectarDB();
    //         $stmt = $db->query("SELECT personal.nombre_p, personal.apellido_p, personal.telefono_p, usuarios.id_usuario, usuarios.username
    //         FROM personal
    //         INNER JOIN usuarios ON personal.id_personal = usuarios.personal_id_personal");
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     } catch (PDOException $e) {
    //         error_log('Error al obtener información de usuarios: ' . $e->getMessage());
    //         return [];
    //     }
    // }
}
?>