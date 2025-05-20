<?php
require_once __DIR__ . '/../../../../config/conexion_db.php';
require_once __DIR__ . '/../../../../config/config.php';

class Usuarios
{
    public static function crearUsuario($nombre_p, $apellido_p, $dni_p, $telefono_p, $correo_elec, $roll_p)
{
    $db = Database::conectarDB();

    // 1. Insertar en personal
    $stmt = $db->prepare("INSERT INTO personal (nombre_p, apellido_p, dni_p, telefono_p, correo_elec, roll_p)
        VALUES (:nombre_p, :apellido_p, :dni_p, :telefono_p, :correo_elec, :roll_p)");
    $stmt->bindParam(':nombre_p', $nombre_p);
    $stmt->bindParam(':apellido_p', $apellido_p);
    $stmt->bindParam(':dni_p', $dni_p);
    $stmt->bindParam(':telefono_p', $telefono_p);
    $stmt->bindParam(':correo_elec', $correo_elec);
    $stmt->bindParam(':roll_p', $roll_p);
    $stmt->execute();

    // 2. Obtener el id_personal recién creado
    $id_personal = $db->lastInsertId();

    $tipo_usuario = (strtolower($roll_p) === 'administrador') ? 'administrador' : 'estandar';

    // 3. Crear usuario en la tabla usuarios
    $username = strtolower($nombre_p . '.' . $apellido_p); // Ejemplo: juan.perez
    $contrasenia = password_hash($dni_p, PASSWORD_DEFAULT); // Ejemplo: usar el DNI como contraseña inicial (encriptada)
    $fecha_creacion = date('Y-m-d H:i:s');

    $stmt2 = $db->prepare("INSERT INTO usuarios (fecha_creacion, tipo_usuario, personal_id_personal, username, contrasenia)
        VALUES (:fecha_creacion, :tipo_usuario, :personal_id_personal, :username, :contrasenia)");
    $stmt2->bindParam(':fecha_creacion', $fecha_creacion);
    $stmt2->bindParam(':tipo_usuario', $tipo_usuario);
    $stmt2->bindParam(':personal_id_personal', $id_personal, PDO::PARAM_INT);
    $stmt2->bindParam(':username', $username);
    $stmt2->bindParam(':contrasenia', $contrasenia);
    $stmt2->execute();

    return true;
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
