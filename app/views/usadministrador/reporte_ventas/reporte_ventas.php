<?php
// session_start();
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../controllers/us_administrador/reporteVentas/vistaReporteVentas.php';
// Calcular cantidad de ventas (número de registros)
$cantidadVentas = count($ventas);

// Asegúrate de que $ventas esté definido y sea un array
$totalVentas = 0;
$usuariosActivos = [];
$fechaHoy = date('Y-m-d');
$cantidadVentas = 0;

if (!empty($ventas) && is_array($ventas)) {
    foreach ($ventas as $venta) {
        // Filtrar solo ventas del día actual
        if (isset($venta['fecha_venta']) && strpos($venta['fecha_venta'], $fechaHoy) === 0) {
            $cantidadVentas++;
            $totalVentas += floatval($venta['total_venta'] ?? 0);
            // Sanitiza los nombres para evitar XSS
            $nombreCompleto = htmlspecialchars(trim(($venta['nombre_vendedor'] ?? '') . ' ' . ($venta['apellido_vendedor'] ?? '')));
            if ($nombreCompleto !== '') {
                $usuariosActivos[$nombreCompleto] = true;
            }
        }
    }
}
$nombresUsuariosActivos = implode(', ', array_keys($usuariosActivos));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Ventas</title>
    <link rel="stylesheet" href="/css/globalStyle.css">
    <link rel="stylesheet" href="/css/reporte_ventas.css">
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
            <div class="main-body-reportVent">
                <div class="upper-body">
                    <!-- Boton para visualizar todo el hisotorial de ventas -->
                    <div>
                        <button onclick="H_ventas()">Historial de ventas</button>
                    </div>
                    <!-- Los botones deben aparecer de las sucursales creadas, mas no manualmente -->
                </div>
                <div class="lower-body" id="principal_contentRV">
                    <div class="content-reporteV">
                        <div class="subtitulo">
                            <h3>Ventas en general del dia</h3>
                        </div>
                        <div class="datos-reporteV">
                            <div class="Cantidad-V">
                                <h4>Cantidad de Ventas</h4><br>
                                <?= htmlspecialchars($cantidadVentas) ?>
                            </div>
                            <div class="Total-V">
                                <h4>Total de Ventas</h4><br>
                                $<?= number_format($totalVentas, 2) ?>
                            </div>
                            <div class="Ususarios-R">
                                <h4>Usuarios Activos</h4><br>
                                <?= $nombresUsuariosActivos ?>
                            </div>
                            <div class="Fecha-RV">
                                <h4>Fecha</h4><br>
                                <?= htmlspecialchars($fechaHoy) ?>
                            </div>
                        </div>
                        <div class="campo-bot_bus">
                            <!-- <div>
                                <input type="text" name="buscar_ventas" class="buscar_ventas" id="buscar_ventas"
                                    placeholder="Buscar por producto o vendedor">
                            </div>
                            <div>
                                <button>Generar PDF</button>
                            </div> -->
                        </div>
                        <div class="lista-ventas">
                            <table>
                                <thead id="tabla_ventas">
                                    <tr>
                                        <th>
                                            Nombre del producto
                                        </th>
                                        <th>
                                            Nombre del Vendedor
                                        </th>
                                        <th>
                                            Sucursal
                                        </th>
                                        <th>Total Venta</th>
                                        <th>Cantidad</th>
                                        <th>Tipo de venta</th>
                                        <th>Tipo de pago</th>
                                        <th>Fecha y Hora</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ventas as $venta): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($venta['nombre_producto']) ?></td>
                                            <td><?= htmlspecialchars($venta['nombre_vendedor'] . ' ' . $venta['apellido_vendedor']) ?>
                                            </td>
                                            <td><?= htmlspecialchars($venta['sucursal']) ?></td>
                                            <td><?= htmlspecialchars($venta['total_venta']) ?></td>
                                            <td><?= htmlspecialchars($venta['cantidad']) ?></td>
                                            <td><?= htmlspecialchars($venta['tipo_venta']) ?></td>
                                            <td><?= htmlspecialchars($venta['tipo_pago']) ?></td>
                                            <td><?= htmlspecialchars($venta['fecha_venta']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                                <!-- Ejemplo -->

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