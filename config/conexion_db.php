<?php
date_default_timezone_set('America/Lima');
class Database
{
    private static $host = 'db';      // O el IP de tu servidor
    private static $dbname = 'branches_db';
    private static $usuario = 'user';
    private static $password = 'password';

    public static function conectarDB()
    {
        try {
            $conexion = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8",
                self::$usuario,
                self::$password
            );
            
            // Opciones recomendadas de seguridad
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET time_zone = '-05:00'");
            return $conexion;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
