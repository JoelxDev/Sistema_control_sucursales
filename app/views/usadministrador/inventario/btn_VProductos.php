<?php
// session_start();
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../models/us_administrador/inventario/modelInventario.php';
$productos = Producto::obtenerTodos();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/globalStyle.css">
    <link rel="stylesheet" href="<?=BASE_URL?>css/btn_VProductos.css">

</head>

<body>
    <!-- Interfaz Para pantallas pequeñas -->

    <div class="encabezado-mvl">
        <div class="cl-titulo">
            <h3 class="titulo-mvl">ADMINISTRADOR</h3>
        </div>
        <div class="img-menu">
            <img src="../../../../public/img/file.png" alt="">

        </div>

    </div>

    <div class="mini-content">
        <div class="mini-encabezado">
            <div class="menu-a">
                <a href="../informacion/informacion.php">
                    <h3>Informacion</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="../sucursales/sucursales.php">
                    <h3>Sucursales</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="../usuarios/usuarios.php">
                    <h3>Usuarios</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="../reporte_ventas/reporte_ventas.php">
                    <h3>Reporte Ventas</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="../inventario/inventario.php">
                    <h3>Inventario</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="../pedidos/pedidos.php">
                    <h3>Pedidos</h3>
                </a>
            </div>
            <div class="mini-menu-b">
                <a href="../../../../logout.php"><h3>Salir</h3></a>
            </div>
        </div>
    </div>
    <!-- Interfaz para pantallas grandes -->
   <div class="encabezado">
            <div class="titulo"><h3>ADMINISTRADOR</h3></div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>admin/informacion"><h3>Informacion</h3></a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>admin/sucursales"><h3>Sucursales</h3></a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>admin/usuarios"><h3>Usuarios</h3></a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>admin/reporte_ventas"><h3>Reporte Ventas</h3></a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>admin/inventario"><h3>Inventario</h3></a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>admin/pedidos"><h3>Pedidos</h3></a>
            </div>
            <div class="menu-b">
                <a href="<?= BASE_URL ?>logout.php"><h3>Salir</h3></a>
            </div>
        </div>
    <!-- Desde aqui se puede modificar para otros modulos -->
    <div class="cuerpo-VProductos" id="cuerpo_VProductos">
        <div class="principal-contentBVP">
            <div class="cuerpo-superior">
                <div>
                    <button class="btn_añadirP" onclick="btn_AProducto()">Añadir producto</button>
                </div>

            </div>
            <div class="cuerpo-inferior">
                <div class="titulo-VProductos">
                    <h3>Productos registrados en el inventario</h3>
                </div>
                <div class="tabla-VProductos">
                    <table>
                        <thead>
                            <tr>
                                <th>ID PRODUCTO</th>
                                <th>NOMBRE DEL PRODUCTO</th>
                                <th>CATEGORIA</th>
                                <th>DESCRIPCION</th>
                                <th>PRECIO UNITARIO</th>
                                <th colspan="3">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($productos)): ?>
                                <?php foreach ($productos as $producto): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($producto['id_producto']) ?></td>
                                        <td><?= htmlspecialchars($producto['nombre_pr']) ?></td>
                                        <td><?= htmlspecialchars($producto['categoria']) ?></td>
                                        <td><?= htmlspecialchars($producto['descripcion_pr']) ?></td>
                                        <td>S/. <?= htmlspecialchars($producto['precio_unitario_pr']) ?></td>
                                        <td>
                                            <!-- Botón Editar -->
                                            <!-- <form action="../../../controllers/us_administrador/inventario/editarProducto.php"
                                                method="get" style="display:inline;">
                                                <input type="hidden" name="id_producto"
                                                    value="<?= htmlspecialchars($producto['id_producto']) ?>">
                                                <button type="submit">Editar</button>
                                            </form> -->
                                            <a href="<?= BASE_URL ?>admin/inventario/EditarProducto?id=<?= $producto['id_producto'] ?>" >Editar</a>
                                            
                                            <!-- Botón Eliminar -->
                                            <form action="<?= BASE_URL ?>admin/inventario/EliminarProducto"
                                                method="post" style="display:inline;"
                                                onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                                                <input type="hidden" name="id_producto"
                                                    value="<?= htmlspecialchars($producto['id_producto']) ?>">
                                                <button type="submit">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" style="text-align:center;">No hay productos registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <script src="<?= BASE_URL ?>js/main.js"></script>

</body>

</html>