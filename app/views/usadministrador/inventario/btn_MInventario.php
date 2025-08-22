<?php
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../controllers/us_administrador/inventario/mostrarMInventario.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimientos Inventario</title>
    <link rel="stylesheet" href="/css/globalStyle.css">
    <link rel="stylesheet" href="/css/inventario.css">
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
        <div class="cuerpo">
            <div class="movi-inventario">
                <div class="upper-body">
                </div>
                <div class="lower-body">
                    <div class="informacion-inventario">
                        <div class="subtitulo">
                            <h3>Historial de Movimientos de Inventario</h3>
                        </div>
                        <div class="cont-inventario" style="overflow-y:auto;" id="scroll-contenedor">
                            <table id="tabla-movimientos">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Sucursal</th>
                                        <th>Producto</th>
                                        <th>Tipo</th>
                                        <th>Cantidad</th>
                                        <th>Época</th>
                                        <th>Motivo</th>
                                        <th>Usuario</th>
                                        <!-- <th>ID Venta</th> -->
                                    </tr>
                                </thead>
                                <tbody id="tbody-movimientos">
                                    <?php foreach ($movimientos as $i => $mov): ?>
                                        <tr <?= $i >= 20 ? 'style="display:none;"' : '' ?>>
                                            <td><?= htmlspecialchars($mov['fecha_movimento']) ?></td>
                                            <td><?= htmlspecialchars($mov['sucursal']) ?></td>
                                            <td><?= htmlspecialchars($mov['producto']) ?></td>
                                            <td><?= htmlspecialchars($mov['tipo_mov']) ?></td>
                                            <td><?= htmlspecialchars($mov['cantidad']) ?></td>
                                            <td><?= htmlspecialchars($mov['epoca']) ?></td>
                                            <td><?= htmlspecialchars($mov['motivo']) ?></td>
                                            <td><?= htmlspecialchars($mov['usuario']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div style="text-align:center; margin:20px 0;">
                                <button id="cargar-mas">Cargar más...</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filas = document.querySelectorAll('#tbody-movimientos tr');
            const btn = document.getElementById('cargar-mas');
            let mostradas = 20;
            const paso = 10;

            btn.addEventListener('click', function() {
                let hayMas = false;
                for (let i = mostradas; i < mostradas + paso && i < filas.length; i++) {
                    filas[i].style.display = '';
                    hayMas = true;
                }
                mostradas += paso;
                if (mostradas >= filas.length) {
                    btn.style.display = 'none';
                }
            });

            // Oculta el botón si hay pocas filas
            if (filas.length <= mostradas) {
                btn.style.display = 'none';
            }
        });
    </script>
</body>

</html>