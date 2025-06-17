<?php
require_once __DIR__ . '/../../../../config/config.php';
// NO pongas aquí la validación de POST
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Sucursal</title>
</head>
<body>
    <h1>Editar Sucursal</h1>
    <form action="/admin/sucursales/editar?id=<?= htmlspecialchars($sucursal['id_sucursal']) ?>" method="POST">
        <input type="hidden" name="id_sucursal" value="<?= htmlspecialchars($sucursal['id_sucursal']) ?>">
        <label for="nombre_s">Nombre:</label>
        <input type="text" id="nombre_s" name="nombre_s" value="<?= htmlspecialchars($sucursal['nombre_s']) ?>" required><br>
        <label for="ubicacion_s">Ubicación:</label>
        <input type="text" id="ubicacion_s" name="ubicacion_s" value="<?= htmlspecialchars($sucursal['ubicacion_s']) ?>" required><br>
        <label for="estado_s">Estado:</label>
        <select id="estado_s" name="estado_s" required>
            <option value="activo" <?= $sucursal['estado_s'] === 'activo' ? 'selected' : '' ?>>Activo</option>
            <option value="inactivo" <?= $sucursal['estado_s'] === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
        </select><br>
        <label for="ciudad_s">Ciudad:</label>
        <input type="text" id="ciudad_s" name="ciudad_s" value="<?= htmlspecialchars($sucursal['ciudad_s']) ?>" required><br>
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
?>