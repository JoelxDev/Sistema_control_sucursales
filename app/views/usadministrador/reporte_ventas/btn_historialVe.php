<?php
// session_start(); // Asegúrate de iniciar la sesión si no está iniciada
require_once __DIR__ . '/../../../controllers/us_administrador/reporteVentas/vistaReporteVentas.php';
$esAdmin = (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'administrador');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de ventas</title>
    <link rel="stylesheet" href="/css/globalStyle.css">
    <link rel="stylesheet" href="/css/btn_historialVe.css">

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
        <!-- Contenido principal -->
        <div class="cuerpo">
            <div class="cont-historialVe">
                <div class="upper-body">
                    <form method="get" style="margin-bottom: 20px;">
                        <input type="date" id="fecha" name="fecha" value="<?= htmlspecialchars($_GET['fecha'] ?? date('Y-m-d')) ?>">
                        <button type="submit" style="padding: 5px;">Filtrar</button>
                    </form>
                    <div class="">
                        <input type="text" id="buscar_movimiento" placeholder="Buscar producto o vendedor...">
                    </div>
                    <!-- <div>
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
                    </div> -->
                </div>
                <div class="lower-body">
                    <div class="cuerpo-HVentas">
                        <div>
                            <div class="subtitulo">
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
                                <?php
                                $fechaFiltro = $_GET['fecha'] ?? date('Y-m-d');
                                $ventasFiltradas = [];
                                foreach ($ventas as $venta) {
                                    if (isset($venta['fecha_venta']) && strpos($venta['fecha_venta'], $fechaFiltro) === 0) {
                                        $ventasFiltradas[] = $venta;
                                    }
                                }
                                ?>
                                <tbody>
                                    <?php if (empty($ventasFiltradas)): ?>
                                        <tr>
                                            <td colspan="9" style="text-align:center;">No hay ventas registradas para la fecha seleccionada.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($ventasFiltradas as $venta): ?>
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
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/main.js"></script>
    <script>
        document.getElementById('buscar_movimiento').addEventListener('keyup', function() {
            let filtro = this.value.toLowerCase();
            let filas = document.querySelectorAll('.tabla-container tbody tr');
            filas.forEach(function(fila) {
                let texto = fila.textContent.toLowerCase();
                fila.style.display = texto.includes(filtro) ? '' : 'none';
            });
        });
    </script>
</body>

</html>