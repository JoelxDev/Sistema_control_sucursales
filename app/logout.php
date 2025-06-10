<?php
session_start();
require_once __DIR__ . '/../config/conexion_db.php';

if (isset($_SESSION['id_usuario']) && isset($_SESSION['id_sucursal'])) {
    $db = Database::conectarDB();
    $hora_salida = date('H:i:s');
    // Actualiza el último registro de usuario_sucursal para este usuario y sucursal
    $stmt = $db->prepare("UPDATE usuario_sucursal SET hora_salida = :hora_salida WHERE usuarios_id_usuario = :usuario AND sucursal_id_sucursal = :sucursal ORDER BY id_usuario_sucursal DESC LIMIT 1");
    $stmt->bindParam(':hora_salida', $hora_salida);
    $stmt->bindParam(':usuario', $_SESSION['id_usuario'], PDO::PARAM_INT);
    $stmt->bindParam(':sucursal', $_SESSION['id_sucursal'], PDO::PARAM_INT);
    $stmt->execute();
}

session_unset();      // Limpia todas las variables de sesión
session_destroy();    // Destruye la sesión actual
header('Location: ../public/'); // Redirige al login
exit;
