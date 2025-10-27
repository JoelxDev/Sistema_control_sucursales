<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/globalStyle.css">
    <!-- <link rel="stylesheet" href="/css/pedidosUE.css"> -->
    <title>Lista de pedidos</title>
</head>

<body>
    <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
    <div style="position:fixed;top:12px;right:12px;padding:10px 14px;border-radius:6px;color:#fff;background:<?= isset($_SESSION['success']) ? '#28a745' : '#dc3545' ?>;z-index:9999;">
        <?= htmlspecialchars($_SESSION['success'] ?? $_SESSION['error']) ?>
    </div>
    <?php unset($_SESSION['success'], $_SESSION['error']); ?>
<?php endif; ?>
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
                <h3>Joel</h3>
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
                    <div class="tabla-lista-pedidos">
                        <div class="subtitulo">
                            <h3>Pedidos registrados </h3>
                        </div>
                        <div class="tabla-pedidos-registrados">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Detalles</th>
                                        <th>Adelanto</th>
                                        <th>Ultimo pago</th>
                                        <th>Fecha pedido</th>
                                        <th>Fecha entrega</th>
                                        <th>Registrado por</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($pedidos)): ?>
                                        <tr>
                                            <td colspan="12" style="text-align:center;color:#666">Sin resultados</td>
                                        </tr>
                                        <?php else: foreach ($pedidos as $p): ?>
                                            <tr>
                                                <td><?= (int)$p['id_pedido'] ?></td>
                                                <td><?= htmlspecialchars($p['cliente_ped'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($p['producto_ped'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($p['cantidad_ped'] ?? ($p['detalles_ped'] ?? '')) ?></td>
                                                <td><?= htmlspecialchars($p['detalles_ped'] ?? '') ?></td>
                                                <td><?= number_format((float)($p['pago_adelanto'] ?? 0), 2) ?></td>
                                                <td><?= htmlspecialchars(((string)($p['pago_completado'] ?? '')) === '1' || strtolower((string)($p['pago_completado'] ?? '')) === 'si' ? 'Sí' : 'No') ?></td>
                                                <td><?= htmlspecialchars($p['fecha_pedido'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($p['fecha_entrega'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($p['nombre_usuario'] ?? '') ?></td>
                                                <td><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $p['estado_ped'] ?? ''))) ?></td>
                                                <td style="white-space:nowrap">
                                                    <a href="<?= BASE_URL ?>usuario/pedidos/editar?id=<?= (int)$p['id_pedido'] ?>"><button class="btn-editar">Editar</button></a>

                                                    <!-- <form action="<?= BASE_URL ?>usuario/pedidos/estado" method="POST" style="display:inline-block;margin-left:8px;">
                                                        <input type="hidden" name="id_pedido" value="<?= (int)$p['id_pedido'] ?>">
                                                        <select name="estado_ped" style="vertical-align:middle">
                                                            <?php foreach (['pendiente', 'en_proceso', 'completado', 'cancelado'] as $est): ?>
                                                                <option value="<?= $est ?>" <?= (($p['estado_ped'] ?? '') === $est) ? 'selected' : '' ?>><?= ucfirst(str_replace('_', ' ', $est)) ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <button type="submit">OK</button>
                                                    </form> -->

                                                    <form action="<?= BASE_URL ?>usuario/pedidos/eliminar" method="POST" style="display:inline-block;margin-left:8px;" onsubmit="return confirm('Eliminar pedido #<?= (int)$p['id_pedido'] ?>?')">
                                                        <input type="hidden" name="id_pedido" value="<?= (int)$p['id_pedido'] ?>">
                                                        <button type="submit" class="btn-eliminar">Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php endforeach;
                                    endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/main.js"></script>
</body>

</html>