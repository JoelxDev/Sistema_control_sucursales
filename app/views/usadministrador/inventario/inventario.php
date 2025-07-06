<?php
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../models/us_administrador/informacion/informacionUsuarios.php';
$inventarios = Producto::obtenerInventarioPorSucursal();
// Agrupar inventarios por sucursal
$sucursales = [];
foreach ($inventarios as $inv) {
    $sucursales[$inv['sucursal']][] = $inv;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/globalStyle.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/inventario.css">
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
                <a href="<?= BASE_URL ?>admin/informacion"><h3>Informacion</h3></a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>admin/sucursales"><h3>Sucursales</h3></a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>admin/usuarios"><h3>Usuarios</h3></a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>admin/reporte_ventas"><h3>Reporte Ventas</h3></a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>admin/inventario"><h3>Inventario</h3></a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>admin/pedidos"><h3>Pedidos</h3></a>
            </div>
            <div class="mini-menu-b">
                <a href="<?= BASE_URL ?>logout"><h3>Salir</h3></a>
            </div>
        </div>
    </div>
    <!-- Interfaz para pantallas grandes -->
    <div class="content">
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
        <div class="cuerpo-inventario">
            <div class="botones-inventario" id="btn_inventario">
                <div>
                    <button onclick="btn_VProductos()">Producto</button>
                    <button onclick="btn_MInventario()">Movimientos Inventario</button>
                </div>
                <!-- Los botones de las sucursales deben aparecer
                automaticamente, mas no crearlos manualmente -->

            </div>
            <div class="inventario">
                <div class="informacion-inventario">
                    <div class="titulo-inventario">
                        <h3>Inventario de las Sucursales</h3>
                    </div>
                    <div class="cont-inventario">
                        <div class="cont-superior">
                            <div>
                            </div>
                        </div>
                        <div class="cont-inferior">
                            <?php
                            // Agrupar por sucursal
                            $sucursales = [];
                            foreach ($inventarios as $inv) {
                                $sucursales[$inv['sucursal']][] = $inv;
                            }
                            ?>
                            <?php foreach ($sucursales as $nombre_sucursal => $inventariosSucursal): ?>
                                <div class="sucursal-card">
                                    <h2 class="sucursal-nombre"><?= htmlspecialchars($nombre_sucursal) ?></h2>
                                    <div class="productos-lista">
                                        <?php foreach ($inventariosSucursal as $inv): ?>
                                            <div class="producto-card">
                                                <div class="producto-nombre"><?= htmlspecialchars($inv['producto']) ?></div>
                                                <div class="producto-cantidad">Cantidad total:
                                                    <b><?= htmlspecialchars($inv['cantidad_total']) ?></b></div>
                                                <div class="producto-fecha">Última actualización:
                                                    <span><?= htmlspecialchars($inv['ultima_actualizacion']) ?></span></div>
                                                <div class="producto-epoca">Época: <?= htmlspecialchars($inv['epoca']) ?></div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="<?= BASE_URL ?>js/main.js"></script>

</body>

</html>