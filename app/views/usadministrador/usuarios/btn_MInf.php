<?php
// session_start();
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../models/us_administrador/usuarios/modelUsuarios.php';

// if (!isset($_POST['id_personal'])) {
//     die("Error: No se proporcionó el ID del usuario.");
// }

// $usuario = Usuarios::obtenerUsuarioPorId($_POST['id_personal']);
// if (!$usuario) {
//     die("Error: Usuario no encontrado.");
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Usuario</title>
</head>
<body>
    <h1>Información del Usuario</h1>
    <ul>
        <li><strong>ID:</strong> <?= htmlspecialchars($usuario['id_personal']) ?></li>
        <li><strong>Nombre:</strong> <?= htmlspecialchars($usuario['nombre_p']) ?></li>
        <li><strong>Apellido:</strong> <?= htmlspecialchars($usuario['apellido_p']) ?></li>
        <li><strong>DNI:</strong> <?= htmlspecialchars($usuario['dni_p']) ?></li>
        <li><strong>Teléfono:</strong> <?= htmlspecialchars($usuario['telefono_p']) ?></li>
        <li><strong>Correo electrónico:</strong> <?= htmlspecialchars($usuario['correo_elec']) ?></li>
        <li><strong>Rol:</strong> <?= htmlspecialchars($usuario['roll_p']) ?></li>
        <li><strong>Username</strong> <?= htmlspecialchars($usuario['username']) ?></li>
        <!-- Agrega aquí más campos si tu tabla tiene más datos -->
    </ul>
</body>
</html>