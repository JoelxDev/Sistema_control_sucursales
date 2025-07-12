<?php
// session_start();
require_once __DIR__ . '/../../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/globalStyle.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/btn_VProductos.css">

</head>

<body>
    <!-- Interfaz Para pantallas pequeñas -->

    <div class="encabezado-mvl">
        <div class="cl-titulo">
            <h3 class="titulo-mvl">ADMINISTRADOR</h3>
        </div>
        <div class="img-menu">
            <img src="<?= BASE_URL ?>/img/file.png" alt="">



        </div>

    </div>

    <div class="mini-content">
        <div class="mini-encabezado">
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>admin/informacion">
                    <h3>Informacion</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>admin/sucursales">
                    <h3>Sucursales</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>admin/usuarios">
                    <h3>Usuarios</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>admin/reporte_ventas">
                    <h3>Reporte Ventas</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>admin/inventario">
                    <h3>Inventario</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>admin/pedidos">
                    <h3>Pedidos</h3>
                </a>
            </div>
            <div class="mini-menu-b">
                <a href="<?= BASE_URL ?>logout">
                    <h3>Salir</h3>
                </a>
            </div>
        </div>
    </div>
    <!-- Interfaz para pantallas grandes -->
    <div class="encabezado">
        <div class="titulo">
            <h3>ADMINISTRADOR</h3>
        </div>
        <div class="menu-a">
            <a href="<?= BASE_URL ?>admin/informacion">
                <h3>Informacion</h3>
            </a>
        </div>
        <div class="menu-a">
            <a href="<?= BASE_URL ?>admin/sucursales">
                <h3>Sucursales</h3>
            </a>
        </div>
        <div class="menu-a">
            <a href="<?= BASE_URL ?>admin/usuarios">
                <h3>Usuarios</h3>
            </a>
        </div>
        <div class="menu-a">
            <a href="<?= BASE_URL ?>admin/reporte_ventas">
                <h3>Reporte Ventas</h3>
            </a>
        </div>
        <div class="menu-a">
            <a href="<?= BASE_URL ?>admin/inventario">
                <h3>Inventario</h3>
            </a>
        </div>
        <div class="menu-a">
            <a href="<?= BASE_URL ?>admin/pedidos">
                <h3>Pedidos</h3>
            </a>
        </div>
        <div class="menu-b">
            <a href="<?= BASE_URL ?>logout">
                <h3>Salir</h3>
            </a>
        </div>
    </div>
    <!-- Desde aqui se puede modificar para otros modulos -->
    <div class="cuerpo" id="">
        <div class="principal-content-editP">
            <div class="upper-body">
            </div>
            <div class="lower-body">
                <div class="cuerpo-inferior-editP">
                    <div class="subtitulo">
                        <h3>Editar Producto</h3>
                    </div>
                    <div class="form-Edit-Producto">
                        <form
                            action="<?= BASE_URL ?>admin/inventario/EditarProducto?id=<?= htmlspecialchars($producto['id_producto']) ?>"
                            method="post"
                            onsubmit="return confirm('¿Estás seguro de que deseas editar este producto?');">
                            <input type="hidden" name="id_producto"
                                value="<?= htmlspecialchars($producto['id_producto']) ?>">
                            <label>Nombre:</label>
                            <input type="text" name="txtnombre_pr"
                                value="<?= htmlspecialchars($producto['nombre_pr']) ?>" required><br>
                            <label>Descripción:</label>
                            <input type="text" name="txtdescripcion_pr"
                                value="<?= htmlspecialchars($producto['descripcion_pr']) ?>" required><br>
                            <label>Precio Unitario:</label>
                            <input type="number" name="txtprecio_pr"
                                value="<?= htmlspecialchars($producto['precio_unitario_pr']) ?>" step="0.01"
                                required><br>
                            <label>Categoría:</label>
                            <input type="text" name="txtcategoria_pr"
                                value="<?= htmlspecialchars($producto['categoria']) ?>" required><br>
                            <button type="submit">Guardar Cambios</button><br>
                            <button>
                                <a href="<?= BASE_URL ?>admin/inventario/Productos" style="color: black">Cancelar</a>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= BASE_URL ?>js/main.js"></script>
</body>
</html>