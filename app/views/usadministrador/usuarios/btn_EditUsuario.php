<?php
require_once __DIR__ . '/../../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
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
        <div class="cuerpo">
        <div class="cuerpo-editar-usuario">
                <div class="upper-body">
                </div>
                <div class="lower-body">
                    <div class="modulo-editar-usuarios">
                        <div class="subtitulo">
                            <h3>Editar Usuario</h3>
                        </div>
                        <div class="form-editar-usuario">
                            <form method="POST"
                                action="<?= BASE_URL ?>admin/usuarios/btn_edit_us?id=<?= htmlspecialchars($usuario['id_personal']) ?>"
                                onsubmit="return confirm('¿Estás seguro de que deseas editar este usuario?');">
                                <input type="hidden" name="id_personal"
                                    value="<?= htmlspecialchars($usuario['id_personal']) ?>">
                                <div>
                                    <label for="nombre_p">Nombre:</label>
                                    <input type="text" id="nombre_p" name="nombre_p"
                                    value="<?= htmlspecialchars($usuario['nombre_p']) ?>" required>
                                </div>
                                <div>
                                    <label for="apellido_p">Apellido:</label>
                                    <input type="text" id="apellido_p" name="apellido_p"
                                        value="<?= htmlspecialchars($usuario['apellido_p']) ?>" required>
                                </div>
                                <div>
                                    <label for="telefono_p">Teléfono:</label>
                                    <input type="text" id="telefono_p" name="telefono_p"
                                        value="<?= htmlspecialchars($usuario['telefono_p']) ?>" required>
                                </div>
                                <div>
                                    <label for="dni_p">DNI:</label>
                                    <input type="text" id="dni_p" name="dni_p"
                                        value="<?= htmlspecialchars($usuario['dni_p']) ?>" required>
                                </div>
                                <div>
                                    <label for="roll_p">Rol:</label>
                                    <select id="roll_p" name="roll_p" required>
                                        <option value="administrador" <?= $usuario['roll_p'] === 'administrador' ? 'selected' : '' ?>>
                                            Administrador</option>
                                    <option value="vendedor" <?= $usuario['roll_p'] === 'vendedor' ? 'selected' : '' ?>>
                                        Vendedor
                                    </option>
                                    </select>
                                </div>
                                <button type="submit" class="btn-editar">Guardar Cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/main.js"></script>
</body>
</html>