<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/globalStyle.css">
    <link rel="stylesheet" href="/css/pedidos.css">
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
            <div class="mini-menu-b">
                <a href="<?= BASE_URL ?>inv/pedidos"><h3>Pedidos</h3></a>
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
                    <!-- <div>
                        <label for="orden_list">Ordenar por</label>
                        <select name="" id="orden_list">
                            <option value="">Hoy</option>
                        </select>
                    </div> -->
                </div>
                <div class="lower-body">
                    <div class="cuad-pedidos">
                        <div class="subtitulo">
                            <h3>Historial de Pedidos</h3>
                        </div>
                        <!-- <div class="infor-pedidos"> -->
                            <div class="infor-tbl-pedidos">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nombre del cliente</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Detalles</th>
                                            <th>Adelanto</th>
                                            <!-- <th>Ultimo pago</th> -->
                                            <th>Fecha registrada</th>
                                            <th>Fecha de entrega</th>
                                            <th>Estado</th>
                                            <th>Sucursal</th>
                                            <th>Nombre del personal</th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                        <?php if (empty($todosPedidos)): ?>
                                            <tr><td colspan="11" style="text-align:center;color:#666">Sin pedidos</td></tr>
                                        <?php else: foreach ($todosPedidos as $tp): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($tp['cliente_ped'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($tp['producto_ped'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($tp['cantidad_ped'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($tp['detalles_ped'] ?? '') ?></td>
                                                <td><?= number_format((float)($tp['pago_adelanto'] ?? 0), 2) ?></td>
                                                <!-- <td><?= number_format((float)($tp['pago_completado'] ?? 0), 2) ?></td> -->
                                                <td><?= htmlspecialchars($tp['fecha_pedido'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($tp['fecha_entrega'] ?? '') ?></td>
                                                <td><?= htmlspecialchars(ucfirst(str_replace('_',' ',$tp['estado_ped'] ?? ''))) ?></td>
                                                <td><?= htmlspecialchars($tp['sucursal'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($tp['personal'] ?? '') ?></td>
                                            </tr>
                                        <?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
                <!-- </div> -->
    </div>
    <script src="/js/main.js"></script>
</body>
</html>