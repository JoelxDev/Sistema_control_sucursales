<?php
require_once __DIR__ . '/../../../controllers/us_estandar/inventarioUE/controller_inventarioUE.php';
require_once __DIR__ . '/../../../../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/globalStyle.css">
    <link rel="stylesheet" href="/css/inventarioUE.css">

    <title>Inventario</title>
</head>

<body>
    <!-- Interfaz Para pantallas pequeñas -->
    <div class="encabezado-mvl">
        <div class="cl-titulo">
            <h3 class="titulo-mvl">SUCURSAL</h3>
        </div>
        <div class="img-menu">
            <img src="<?= BASE_URL ?>/img/file.png" alt="">
        </div>

    </div>
    <div class="mini-content">
        <div class="mini-encabezado">
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>usuario/perfil">
                    <h3>Informacion</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>usuario/ventas">
                    <h3>Registrar Venta</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>usuario/inventario">
                    <h3>Inventario</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>usuario/pedidos">
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
    <div class="content">
        <div class="encabezado">
            <div class="titulo">
                <h3>SUCURSAL</h3>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>usuario/perfil">
                    <h3>Informacion</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>usuario/ventas">
                    <h3>Registrar Venta</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>usuario/inventario">
                    <h3>Inventario</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>usuario/pedidos">
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
        <div class="cuerpo">
            <div class="inventario-main-body">
                <div class="upper-body">
                    <div class="buscar-producto">
                        <!-- <input type="text" placeholder="Buscar un producto"> -->
                    </div>
                    <div class="btn_actualizarInvenario">
                        <!-- <button onclick="btn_actualizarInventarioUE()">Actualizar inventario</button> -->
                    </div>
                </div>
                <div class="lower-body">
                    <div class="inventario">
                        <div class="subtitulo">
                            <h3>Inventario actual de la sucursal</h3>
                        </div>
                        <div class="vista-inventario">
                            <?php foreach ($inventario as $producto): ?>
                                <div class="producto_invetario" data-id="<?= $producto['id_producto'] ?>">
                                    <div class="nom_producto">
                                        <h3><?= htmlspecialchars($producto['nombre_pr']) ?></h3>
                                    </div>
                                    <div class="datos-producto">
                                        <div class="cantidad_producto">
                                            <h4>Cantidad: <?= $producto['cantidad_total'] ?></h4>
                                        </div>
                                        <!-- Si tienes precio, agrégalo aquí -->

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/main.js"></script>
</body>

</html>