<?php
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../controllers/us_administrador/contrll_informacion/mostrarInformacion.php';

$id_usuario = $_SESSION['id_usuario'] ?? null;
if (!$id_usuario) {
    // Si no hay sesión, redirige al login
    header('Location: ' . BASE_URL . 'public/');
    exit;
}

// $usuario = informacionUsuario::obtenerPorId($id_usuario);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/globalStyle.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/informacion.css">

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
            <div class="main-body-info">
                <div class="upper-body">
                </div>
                <div class="lower-body">
                    <div class="modulo-informacion">
                        <div class="subtitulo">
                            <h3>Informacion basica sobre el usuario</h3>
                        </div>
                        <div class="perfil">
                            <div class="circulo"></div>
                        </div>
                        <div class="informacion">
                            <?php if ($usuario): ?>
                                <div class="dat">ID usuario:
                                    <b><?= htmlspecialchars($usuario['id_usuario']) ?></b>
                                </div>
                                <div class="dat">Nombre de usuario:
                                    <b><?= htmlspecialchars($usuario['username']) ?></b>
                                </div>
                                <div class="dat">Nombre:
                                    <b> <?= htmlspecialchars($usuario['nombre_p']) ?></b>
                                </div>
                                <div class="dat">Apellido:
                                    <b><?= htmlspecialchars($usuario['apellido_p']) ?></b>
                                </div>
                                <div class="dat">Telefono:
                                    <b><?= htmlspecialchars($usuario['telefono_p']) ?></b>
                                </div>
                            <?php else: ?>
                                <p style="color: red;">Usuario no encontrado.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= BASE_URL ?>js/main.js"></script>

</body>

</html>