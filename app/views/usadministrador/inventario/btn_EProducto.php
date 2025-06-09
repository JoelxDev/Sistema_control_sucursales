<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../../../../public/css/globalStyle.css">
    <link rel="stylesheet" href="../../../../public/css/btn_AProducto.css">
</head>
<body>
    <h2>Editar Producto</h2>
    <form action="../../../controllers/us_administrador/inventario/editarProducto.php" method="post"
    onsubmit="return confirm('¿Estás seguro de que deseas editar este usuario?');">
        <input type="hidden" name="id_producto" value="<?= htmlspecialchars($producto['id_producto']) ?>">
        <label>Nombre:</label>
        <input type="text" name="txtnombre_pr" value="<?= htmlspecialchars($producto['nombre_pr']) ?>" required><br>
        <label>Descripción:</label>
        <input type="text" name="txtdescripcion_pr" value="<?= htmlspecialchars($producto['descripcion_pr']) ?>" required><br>
        <label>Precio Unitario:</label>
        <input type="number" name="txtprecio_pr" value="<?= htmlspecialchars($producto['precio_unitario_pr']) ?>" step="0.01" required><br>
        <label>Categoría:</label>
        <input type="text" name="txtcategoria_pr" value="<?= htmlspecialchars($producto['categoria']) ?>" required><br>
        <button type="submit">Guardar Cambios</button>
        <a href="<?= BASE_URL ?>app/views/usadministrador/inventario/btn_VProductos.php">Cancelar</a>
    </form>
</body>
</html>