<?php
// session_start(); // Asegúrate de iniciar la sesión si no está iniciada
require_once __DIR__ . '/../../../models/us_administrador/reporte-ventas/modelReVentas.php';
$ventas = Ventas::obtenerVentas();
$esAdmin = (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'administrador');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de ventas</title>
        <link rel="stylesheet" href="<?= BASE_URL ?>css/globalStyle.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/btn_historialVe.css">

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
    <div class="content">
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
                <a href="<?= BASE_URL ?>logout"><h3>Salir</h3></a>
            </div>
        </div>
        <!-- Desde aqui se puede modificar para otros modulos -->
        <!-- Contenido principal -->
        <div class="principal-HV">
            <div class="cont-historialVe">
                <div class="encabezado-HV">
                    <div class="buscar-HV">
                        <input type="text" class="buscar_Dt_HV" id="buscar_Dt_HV"
                            placeholder="Buscar por fecha, vendedor, producto, tipo de venta o pago">
                    </div>
                    <div>
                        <label for="ordenarHV">Ordenar por:</label><br>
                        <select name="ordenarHV" id="ordenarHV">
                            <option value="fecha">Fecha</option>
                            <option value="mas_vendidos">Más Vendidos</option>
                            <option value="menos_vendidos">Menos Vendidos</option>
                            <option value="venta_mixta">Venta Mixta</option>
                            <option value="venta_producto">Venta Por Producto</option>
                            <option value="pago_efectivo">Pago Efectivo</option>
                            <option value="pago_digital">Pago Digital</option>
                        </select>
                    </div>
                </div>
                <div class="cuerpo-HVentas">
                    <div>
                        <div class="titulo-hist">
                            <h3>Historial de Ventas</h3>
                        </div>
                    </div>
                    <div class="tabla-container">
                        <table>
                            <thead>
                                <tr>
                                    <?php if ($esAdmin): ?>
                                        <th>ID Venta</th>
                                    <?php endif; ?>
                                    <th>Vendedor</th>
                                    <th>Tipo de Venta</th>
                                    <th>Producto</th>
                                    <th>Precio Unitario</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Tipo de Pago</th>
                                    <th>Fecha y Hora Registrada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ventas as $venta): ?>
                                    <tr>
                                        <?php if ($esAdmin): ?>
                                            <td><?= htmlspecialchars($venta['id_venta'] ?? '') ?></td>
                                        <?php endif; ?>
                                        <td><?= htmlspecialchars(($venta['nombre_vendedor'] ?? '') . ' ' . ($venta['apellido_vendedor'] ?? '')) ?></td>
                                        <td><?= htmlspecialchars($venta['tipo_venta'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($venta['nombre_producto'] ?? '') ?></td>
                                        <td>S/.<?= number_format($venta['precio_unitario'] ?? 0, 2) ?></td>
                                        <td><?= htmlspecialchars($venta['cantidad'] ?? '') ?></td>
                                        <td>S/.<?= number_format($venta['total_venta'] ?? 0, 2) ?></td>
                                        <td><?= htmlspecialchars($venta['tipo_pago'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($venta['fecha_venta'] ?? '') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>