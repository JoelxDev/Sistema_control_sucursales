<?php
require_once __DIR__ . '/../../../../config/conexion_db.php';
require_once __DIR__ . '/../../../../config/config.php';

class Usuarios
{
    public static function crearUsuario($nombre_p, $apellido_p, $dni_p, $telefono_p, $correo_elec, $roll_p)
    {
        $db = Database::conectarDB();
        $stmt = $db->prepare("INSERT INTO personal (nombre_p, apellido_p, dni_p, telefono_p, correo_elec, roll_p)
        VALUES (:txtnombre_p, :txtapellido_p, :txtdni_p, :txttelefono_p, :txtcorreo_p, :txtroll_p)");
        $stmt->bindParam(':txtnombre_p', $nombre_p);
        $stmt->bindParam(':txtapellido_p', $apellido_p);
        $stmt->bindParam(':txtdni_p', $dni_p);
        $stmt->bindParam(':txttelefono_p', $telefono_p);
        $stmt->bindParam(':txtcorreo_p', $correo_elec);
        $stmt->bindParam(':txtroll_p', $roll_p);
        return $stmt->execute();
    }
    public static function obtenerTodosUsuarios()
    {
        $db = Database::conectarDB();
        $stmt = $db->prepare("SELECT * FROM personal");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function eliminarUsuario($id_usuario)
    {
        $db = Database::conectarDB();
        $stmt = $db->prepare("DELETE FROM personal WHERE id_personal = :id_personal");
        $stmt->bindParam(':id_personal', $id_usuario, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function obtenerUsuarioPorId($id_usuario)
    {
        $db = Database::conectarDB();
        $stmt = $db->prepare("SELECT * FROM personal WHERE id_personal = :id_personal");
        $stmt->bindParam(':id_personal', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function editarUsuario($id_usuario, $nombre_p, $apellido_p, $telefono_p, $roll_p)
    {
        $db = Database::conectarDB();
        $stmt = $db->prepare("UPDATE personal SET nombre_p = :nombre_p, apellido_p = :apellido_p, telefono_p = :telefono_p, roll_p = :roll_p WHERE id_personal = :id_personal");
        $stmt->bindParam(':id_personal', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_p', $nombre_p);
        $stmt->bindParam(':apellido_p', $apellido_p);
        $stmt->bindParam(':telefono_p', $telefono_p);
        $stmt->bindParam(':roll_p', $roll_p);
        return $stmt->execute();
    }
}
