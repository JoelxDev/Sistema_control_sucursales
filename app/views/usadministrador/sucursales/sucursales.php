<?php
// session_start();
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../models/us_administrador/sucursales/modelSucursal.php';

// Obtener todas las sucursales
$sucursales = Sucursal::obtenerTodas();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucursales</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/globalStyle.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/sucursal.css">
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
                <a href="<?= BASE_URL ?>logout.php"><h3>Salir</h3></a>
            </div>
        </div>
        <!-- Desde aqui se puede modificar para otros modulos -->
        <div class="cuerpo-S">
            <div class="boton-sucursal">
                <button class="anadir-sucursal" onclick="A_sucursal()">Añadir Sucursal</button>
            </div>
            <div class="modulos-sucursales" id="moduloSucursal">
                <?php foreach ($sucursales as $sucursal): ?>
                    <div id="cont-sucursal">
                        <div class="titulo-S">
                            <h3><?= htmlspecialchars($sucursal['nombre_s']) ?></h3>
                        </div>
                        <div class="datos-sucursal">
                            <div class="ubicacion-S">
                                <?= htmlspecialchars($sucursal['ubicacion_s']) ?><br>
                            </div>
                            <div class="ciudad-S">
                                <?= htmlspecialchars($sucursal['ciudad_s']) ?>
                            </div>
                            <div class="estado-S">
                                <label for="estado">Estado</label><br>
                                <select name="estado" id="estado">
                                    <option value="activo" <?= $sucursal['estado_s'] === 'activo' ? 'selected' : '' ?>>Activo
                                    </option>
                                    <option value="inactivo" <?= $sucursal['estado_s'] === 'inactivo' ? 'selected' : '' ?>>
                                        Inactivo</option>
                                </select>
                            </div>
                            <div class="botones-S">
                                <!-- Botón para editar -->
                                <!-- <form action="/admin/sucursales/editar?id=<?= $sucursal['id_sucursal'] ?>" method="POST" >                                     
                                    <input type="hidden" name="id_sucursal" value="<?= $sucursal['id_sucursal'] ?>">
                                    <input type="hidden" name="nombre_s" value="<?= $sucursal['nombre_s'] ?>">
                                    <input type="hidden" name="ubicacion_s" value="<?= $sucursal['ubicacion_s'] ?>">
                                    <input type="hidden" name="estado_s" value="<?= $sucursal['estado_s'] ?>">
                                    <input type="hidden" name="ciudad_s" value="<?= $sucursal['ciudad_s'] ?>">
                                    <button type="submit" class="modificar-btn">Modificar</button>
                                </form> -->
                                <a href="/admin/sucursales/editar?id=<?= $sucursal['id_sucursal'] ?>" class="modificar-btn">Modificar</a>

                                <!-- Botón para eliminar -->
                                <form method="POST" action="/admin/sucursales/eliminar" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta sucursal?');">
                                    <input type="hidden" name="id_sucursal" value="<?= $sucursal['id_sucursal'] ?>">
                                    <button type="submit" class="eliminar-btn">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
    <script src="<?= BASE_URL ?>js/main.js"></script>
</body>

</html>