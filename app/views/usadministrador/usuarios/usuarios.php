<?php
// session_start();
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../controllers/us_administrador/usuarios/vistaUsuarios.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="/css/globalStyle.css">
    <link rel="stylesheet" href="/css/usuarios.css">
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
        <div class="cuerpo">
            <div class="main-body-usuarios">
                <div class="upper-body">
                    <!-- <div>
                        <input type="text" name="buscar_usuario" class="buscar_usuario" id="buscar_usuarios"
                            placeholder="Buscar por nombre">
                    </div> -->
                    <div>
                        <button class="button-crearU" onclick="C_usuarios()">Crear usuarios</button>
                    </div>
                </div>
                <div class="lower-body">
                    <div class="modulo-usuarios">
                        <div class="subtitulo">
                            <h3>Lista de usuarios</h3>
                        </div>
                        <div class="tabla-usuarios">
                            <table>
                                <thead>
                                    <tr>
                                        <!-- <th>Username</th> -->
                                        <th>Primer Nombre</th>
                                        <th>Primer Apellido</th>
                                        <!-- <th>Tipo Usuario</th> -->
                                        <th>Roll</th>
                                        <th>Telefono</th>
                                        <th colspan="3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($usuarios as $usuario): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($usuario['nombre_p']) ?></td>
                                            <td><?= htmlspecialchars($usuario['apellido_p']) ?></td>
                                            <td><?= htmlspecialchars($usuario['roll_p']) ?></td>
                                            <td><?= htmlspecialchars($usuario['telefono_p']) ?></td>
                                            <td class="bott">
                                                <a
                                                    href="<?= BASE_URL ?>admin/usuarios/btn_edit_us?id=<?= $usuario['id_personal'] ?>">
                                                    <button type="button" class="btn-editar">Editar</button>
                                                </a>
                                            </td>
                                            <td class="bott">
                                                <form method="POST" action="<?= BASE_URL ?>admin/usuarios/eliminar"
                                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                                    <input type="hidden" name="id_personal"
                                                        value="<?= $usuario['id_personal'] ?>">
                                                    <button type="submit" class="btn-eliminar">Eliminar</button>
                                                </form>
                                            </td>
                                            <td class="bott">
                                                <a
                                                    href="<?= BASE_URL ?>admin/usuarios/MasInformacion?id=<?= $usuario['id_personal'] ?>">
                                                    <button type="button" class="btn-mas-info">M.Inf</button>
                                                </a>
                                            </td>
                                        <tr>
                                        <?php endforeach; ?>
                                        <!-- Para una nueva lista de datos, crear un nuevo 'tr' -->
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