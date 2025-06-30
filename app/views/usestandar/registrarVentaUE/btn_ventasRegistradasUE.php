<?php
require_once __DIR__ . '/../../../controllers/us_estandar/registrarVentaUE/contll_ventasRegistradas.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/globalStyle.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/btn_ventasRegistradasUE.css">
    <title>Ventas registradas</title>
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
                <a href="../informacionUE/informacionUE.php">
                    <h3>Informacion</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="../registrarVentaUE/registrarVentaUE.php">
                    <h3>Registrar Venta</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="../inventarioUE/inventarioUE.php">
                    <h3>Inventario</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="../pedidosUE/pedidosUE.php">
                    <h3>Pedidos</h3>
                </a>
            </div>
            <div class="mini-menu-b">
                <a href="../../../logout.php">
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

        <div class="reg-vent-body">
            <div class="main-body">
                <div class="reg-vent-upper-body">
                    <div>
                        <label for="orden_list">Ordenar por</label>
                        <select name="" id="orden_list">
                            <option value="">Hoy</option>
                        </select>
                    </div>
                </div>
                <div class="reg-vent-lower-body">
                    <div class="tabla-list-ventas">
                        <div class="titulo-ventas-registradas">
                            <h3>Ventas regsitradas por el usuario</h3>
                        </div>
                        <div class="tabla-ventas-registradas">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sucursal</th>
                                        <th>Usuario</th>
                                        <th>Tipo de venta</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Sub Total</th>
                                        <th>Total</th>
                                        <th>Metodo de pago</th>
                                        <th>Fecha y Hora</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($ventas)): ?>
                                        <?php foreach ($ventas as $venta): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($venta['nombre_s']) ?></td>
                                                <td><?= htmlspecialchars($venta['username']) ?></td>
                                                <td><?= htmlspecialchars($venta['tipo_venta']) ?></td>
                                                <td><?= htmlspecialchars($venta['producto']) ?></td>
                                                <td><?= htmlspecialchars($venta['cantidad_dv']) ?></td>
                                                <td><?= htmlspecialchars($venta['precio_unitario']) ?></td>
                                                <td><?= htmlspecialchars($venta['subtotal']) ?></td>
                                                <td><?= htmlspecialchars($venta['total']) ?></td>
                                                <td><?= htmlspecialchars($venta['metodo_pago']) ?></td>
                                                <td><?= htmlspecialchars($venta['fecha_venta']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="10" style="text-align:center;">No hay ventas registradas.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>