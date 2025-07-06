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
        <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
            <div id="mensaje-flotante" style="position:fixed;top:20px;right:20px;z-index:9999;
                padding:15px 25px;border-radius:6px;
                color:#fff;
                background:<?= isset($_SESSION['success']) ? '#28a745' : '#dc3545' ?>;
                box-shadow:0 2px 8px rgba(0,0,0,0.15);">
                <?= isset($_SESSION['success']) ? $_SESSION['success'] : $_SESSION['error'] ?>
            </div>
            <script>
                setTimeout(() => {
                    const msg = document.getElementById('mensaje-flotante');
                    if (msg) msg.style.display = 'none';
                }, 3000);
            </script>
            <?php unset($_SESSION['success'], $_SESSION['error']); ?>
        <?php endif; ?>
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
                                <a href="/admin/sucursales/editar?id=<?= $sucursal['id_sucursal'] ?>"
                                    class="modificar-btn">Modificar</a>

                                <!-- Botón para eliminar -->
                                <form method="POST" action="/admin/sucursales/eliminar" style="display: inline;"
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta sucursal?');">
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