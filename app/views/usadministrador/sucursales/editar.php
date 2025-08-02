<?php
// session_start();
require_once __DIR__ . '/../../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Sucursal</title>
    <link rel="stylesheet" href="/css/globalStyle.css">
    <link rel="stylesheet" href="/css/sucursal.css">
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
            <div class="cuerpo-edit-sucursal">
                <div class="upper-body">

                </div>
                <div class="lower-body">
                    <div class="subtitulo">
                        <h3>Editar Sucursal</h3>
                    </div>
                    <div class="formulario-edit-sucursal">
                        <form action="/admin/sucursales/editar?id=<?= htmlspecialchars($sucursal['id_sucursal']) ?>"
                            method="POST">
                            <input type="hidden" name="id_sucursal"
                                value="<?= htmlspecialchars($sucursal['id_sucursal']) ?>">
                            <label for="nombre_s">Nombre:</label>
                            <input type="text" id="nombre_s" name="nombre_s"
                                value="<?= htmlspecialchars($sucursal['nombre_s']) ?>" required><br>
                            <label for="ubicacion_s">Ubicación:</label>
                            <input type="text" id="ubicacion_s" name="ubicacion_s"
                                value="<?= htmlspecialchars($sucursal['ubicacion_s']) ?>" required><br>
                            <label for="estado_s">Estado:</label>
                            <select id="estado_s" name="estado_s" required>
                                <option value="activo" <?= $sucursal['estado_s'] === 'activo' ? 'selected' : '' ?>>Activo
                                </option>
                                <option value="inactivo" <?= $sucursal['estado_s'] === 'inactivo' ? 'selected' : '' ?>>
                                    Inactivo
                                </option>
                            </select><br>
                            <label for="ciudad_s">Ciudad:</label>
                            <input type="text" id="ciudad_s" name="ciudad_s"
                                value="<?= htmlspecialchars($sucursal['ciudad_s']) ?>" required><br>
                            <button type="submit">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="/js/main.js"></script>
</body>

</html>