<?php
require_once __DIR__ . '/../../../controllers/us_inventario/inventarioUI/con_historialAsigUI.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/globalStyle.css">
    <link rel="stylesheet" href="/css/btn_ventasRegistradasUE.css">
    <title>Historial de Asignaciones</title>
</head>

<body>
    <!-- Interfaz Para pantallas pequeñas -->
    <div class="encabezado-mvl">
        <div class="cl-titulo">
            <h3 class="titulo-mvl">INVENTARIADO</h3>
        </div>
        <div class="img-menu">
            <img src="<?= BASE_URL ?>/img/file.png" alt="">

        </div>

    </div>
    <div class="mini-content"> 
        <div class="mini-encabezado">
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>inv/informacion"><h3>Informacion</h3></a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>inv/inventario"><h3>Inventario</h3></a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>inv/pedidos">
                    <h3>Pedidos</h3>
                </a>
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
                <h3>INVENTARIADO: </h3>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>inv/informacion">
                    <h3>Informacion</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>inv/inventario">
                    <h3>Inventario</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>inv/pedidos">
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

        <!-- <div class="reg-vent-body"> -->
            <div class="main-body">
                <div class="upper-body">
                    <div>
                        <label for="orden_list">Ordenar por</label>
                        <select name="" id="orden_list">
                            <option value="">Hoy</option>
                        </select>
                    </div>
                </div>
                <div class="lower-body">
                    <div class="tabla-list-asignaciones">
                        <div class="subtitulo">
                            <h3>Historial de Asignaciones registradas</h3>
                        </div>
                        <div class="historial-asignaciones">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Producto</th>
                                        <th>Sucursal</th>
                                        <th>Cantidad</th>
                                        <th>Época</th>
                                        <th>Motivo</th>
                                        <th>Usuario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($historial)): ?>
                                        <?php foreach ($historial as $asig): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($asig['fecha_movimento']) ?></td>
                                                <td><?= htmlspecialchars($asig['producto']) ?></td>
                                                <td><?= htmlspecialchars($asig['sucursal']) ?></td>
                                                <td><?= htmlspecialchars($asig['cantidad']) ?></td>
                                                <td><?= htmlspecialchars($asig['epoca']) ?></td>
                                                <td><?= htmlspecialchars($asig['motivo']) ?></td>
                                                <td><?= htmlspecialchars($asig['username']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" style="text-align:center;">No hay asignaciones registradas.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <!-- </div> -->
    </div>
    <script src="/js/main.js"></script>
</body>
</html>