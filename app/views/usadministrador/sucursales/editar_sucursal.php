<?php
session_start();
require_once __DIR__ . '/../../../../config/config.php';

if (!isset($_POST['id_sucursal'], $_POST['nombre_s'], $_POST['ubicacion_s'], $_POST['estado_s'], $_POST['ciudad_s'])) {
    die("Error: Datos insuficientes para editar la sucursal." );
}
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

    <form method="POST" action="<?= BASE_URL ?>app/controllers/us_administrador/sucursales/editarSucursal.php" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas editar esta sucursal?');" >
        <input type="hidden" name="id_sucursal" value="<?= htmlspecialchars($_POST['id_sucursal']) ?>">
        <label for="nombre_s">Nombre:</label>
        <input type="text" id="nombre_s" name="nombre_s" value="<?= htmlspecialchars($_POST['nombre_s']) ?>" required><br>
        <label for="ubicacion_s">Ubicación:</label>
        <input type="text" id="ubicacion_s" name="ubicacion_s" value="<?= htmlspecialchars($_POST['ubicacion_s']) ?>" required><br>
        <label for="estado_s">Estado:</label>
        <select id="estado_s" name="estado_s" required>
            <option value="activo" <?= $_POST['estado_s'] === 'activo' ? 'selected' : '' ?>>Activo</option>
            <option value="inactivo" <?= $_POST['estado_s'] === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
        </select><br>
        <label for="ciudad_s">Ciudad:</label>
        <input type="text" id="ciudad_s" name="ciudad_s" value="<?= htmlspecialchars($_POST['ciudad_s']) ?>" required><br>
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>