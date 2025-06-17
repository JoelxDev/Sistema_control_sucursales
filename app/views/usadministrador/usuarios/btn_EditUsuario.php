<?php
// session_start();
require_once __DIR__ . '/../../../../config/config.php';

// if (!isset($_POST['id_personal'])) {
//     die("Error: No se proporcionó el ID del usuario.");
// }

// // Obtener los datos del usuario desde la base de datos
// require_once __DIR__ . '/../../../models/us_administrador/usuarios/modelUsuarios.php';
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
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form method="POST" action="<?= BASE_URL ?>admin/usuarios/btn_edit_us?id=<?= htmlspecialchars($usuario['id_personal']) ?>"
    onsubmit="return confirm('¿Estás seguro de que deseas editar este usuario?');">
        <input type="hidden" name="id_personal" value="<?= htmlspecialchars($usuario['id_personal']) ?>">
        <label for="nombre_p">Nombre:</label>
        <input type="text" id="nombre_p" name="nombre_p" value="<?= htmlspecialchars($usuario['nombre_p']) ?>" required><br>
        <label for="apellido_p">Apellido:</label>
        <input type="text" id="apellido_p" name="apellido_p" value="<?= htmlspecialchars($usuario['apellido_p']) ?>" required><br>
        <label for="telefono_p">Teléfono:</label>
        <input type="text" id="telefono_p" name="telefono_p" value="<?= htmlspecialchars($usuario['telefono_p']) ?>" required><br>
        <label for="roll_p">Rol:</label>
        <select id="roll_p" name="roll_p" required>
            <option value="administrador" <?= $usuario['roll_p'] === 'administrador' ? 'selected' : '' ?>>Administrador</option>
            <option value="vendedor" <?= $usuario['roll_p'] === 'vendedor' ? 'selected' : '' ?>>Vendedor</option>
        </select><br>
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>