<?php
// session_start();
require_once __DIR__ . '/../../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Producto</title>
    <link rel="stylesheet" href="/css/globalStyle.css">
    <link rel="stylesheet" href="/css/btn_AProducto.css">

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
    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red; text-align:center"><?= $_SESSION['error'] ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <p style="color: green;"><?= $_SESSION['success'] ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <div class="cuerpo">
        <div class="AP-main-body">
            <div class="upper-body">
                <!-- No hay contenido -->
            </div>
            <div class="lower-body">
                <div class="formulario-AP">
                    <form action="<?= BASE_URL ?>admin/inventario/AnadirProducto" method="post">
                        <div class="subtitulo">
                            <h3>Detalles del Producto a registrar</h3>
                        </div>
                        <div class="datos-formulario-AP">
                            <div>
                                <label for="txtnombre_pr">Nombre del Producto</label><br>
                                <input type="text" name="txtnombre_pr" id="txtnombre_pr"
                                    placeholder="Nombre del Producto" required>
                            </div>
                            <div>
                                <label for="txtdescripcion_pr">Descripcion</label><br>
                                <input type="text" name="txtdescripcion_pr" id="txtdescripcion_pr"
                                    placeholder="Descripcion" required>
                            </div>
                            <div>
                                <label for="txtprecio_pr">Precio Unitario</label><br>
                                <input type="number" step="any" name="txtprecio_pr" id="txtprecio_pr"
                                    placeholder="Precio Unitario" required>
                            </div>
                            <!-- <div>
                            <label for="txtunidades_pr">Unidades</label><br>
                            <input type="number" name="txtunidades_pr" id="txtunidades_pr" placeholder="Unidades" >
                        </div> -->
                            <div>
                                <label for="txtcaregoria">Categoria</label><br>
                                <input type="text" name="txtcategoria_pr" id="txtcategoria_pr" placeholder="Categoria"
                                    required>
                            </div>
                            <div>
                                <button type="submit" class="btn-registrar">Registrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="/js/main.js"></script>
</body>

</html>