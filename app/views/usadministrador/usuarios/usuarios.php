<?php
session_start();
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../models/us_administrador/usuarios/modelUsuarios.php';

// Obtener todas las sucursales
$usuarios = Usuarios::obtenerTodosUsuarios();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="../../../../public/css/globalStyle.css">

    <link rel="stylesheet" href="../../../../public/css/usuarios.css">
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
            <div class="titulo">
                <h3>ADMINISTRADOR</h3>
            </div>
            <div class="menu-a">
                <a href="../informacion/informacion.php">
                    <h3>Informacion</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="../sucursales/sucursales.php">
                    <h3>Sucursales</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="../usuarios/usuarios.php">
                    <h3>Usuarios</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="../reporte_ventas/reporte_ventas.php">
                    <h3>Reporte Ventas</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="../inventario/inventario.php">
                    <h3>Inventario</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="../pedidos/pedidos.php">
                    <h3>Pedidos</h3>
                </a>
            </div>
            <div class="menu-b">
                <a href="../../../logout.php"><h3>Salir</h3></a>
            </div>
        </div>
        <!-- Desde aqui se puede modificar para otros modulos -->
        <div class="cuerpo">
            <div class="encabezado-modulo">
                <div>
                    <input type="text" name="buscar_usuario" class="buscar_usuario" id="buscar_usuarios"
                        placeholder="Buscar por nombre">
                </div>
                <div>
                    <button class="button-crearU" onclick="C_usuarios()">Crear usuarios</button>
                </div>
            </div>
            <div class="modulo-usuarios">
                <div class="titulo-modulo">
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
                                        <form method="POST"
                                            action="<?= BASE_URL ?>app/views/usadministrador/usuarios/btn_EditUsuario.php">
                                            <input type="hidden" name="id_personal" value="<?= $usuario['id_personal'] ?>">
                                            <button type="submit">Editar</button>
                                        </form>
                                    </td>
                                    <td class="bott">
                                        <form method="POST"
                                            action="<?= BASE_URL ?>app/controllers/us_administrador/usuarios/eliminarUsuario.php"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                            <input type="hidden" name="id_personal" value="<?= $usuario['id_personal'] ?>">
                                            <button type="submit">Eliminar</button>
                                        </form>
                                    </td>
                                    <td class="bott">
                                        <form method="POST"
                                            action="<?= BASE_URL ?>app/views/usadministrador/usuarios/btn_MInf.php">
                                            <input type="hidden" name="id_personal" value="<?= $usuario['id_personal'] ?>">
                                            <button type="submit">M.Inf</button>
                                        </form>
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
    <script src="../../../../public/js/main.js"></script>

</body>

</html>