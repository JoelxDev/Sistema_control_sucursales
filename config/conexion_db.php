<?php

class Database
{
    private static $host = 'localhost';      // O el IP de tu servidor
    private static $dbname = 'branches_db';
    private static $usuario = 'root';
    private static $password = '';

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
            return $conexion;

        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
