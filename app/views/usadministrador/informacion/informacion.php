<?php
session_start();
// require_once '../../../models/login.php';
require_once __DIR__ . '/../../../models/informacionUsuarios.php';
require_once  __DIR__ .  '/../../../../config/config.php';

if (!isset($_SESSION['id_usuario'])) {
    header('Location: ' . BASE_URL . 'public/index.php'); // Redirige al archivo de inicio de sesión
    exit;
}

$usuario = informacionUsuario::obtenerPorId($_SESSION['id_usuario']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion</title>
    <link rel="stylesheet" href="../../../../public/css/globalStyle.css">
    <link rel="stylesheet" href="../../../../public/css/informacion.css">
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
                <a href="../informacion/informacion.php"><h3>Informacion</h3></a>
            </div>
            <div class="mini-menu-a">
                <a href="../sucursales/sucursales.php"><h3>Sucursales</h3></a>
            </div>
            <div class="mini-menu-a">
                <a href="../usuarios/usuarios.php"><h3>Usuarios</h3></a>
            </div>
            <div class="mini-menu-a">
                <a href="../reporte_ventas/reporte_ventas.php"><h3>Reporte Ventas</h3></a>
            </div>
            <div class="mini-menu-a">
                <a href="../inventario/inventario.php"><h3>Inventario</h3></a>
            </div>
            <div class="mini-menu-a">
                <a href="../pedidos/pedidos.php"><h3>Pedidos</h3></a>
            </div>
            <div class="mini-menu-b"><h3>Salir</h3></div>
        </div>
    </div>
    <!-- Interfaz para pantallas grandes -->
    <div class="content">
        <div class="encabezado">
            <div class="titulo"><h3>ADMINISTRADOR</h3></div>
            <div class="menu-a">
                <a href="../informacion/informacion.php"><h3>Informacion</h3></a>
            </div>
            <div class="menu-a">
                <a href="../sucursales/sucursales.php"><h3>Sucursales</h3></a>
            </div>
            <div class="menu-a">
                <a href="../usuarios/usuarios.php"><h3>Usuarios</h3></a>
            </div>
            <div class="menu-a">
                <a href="../reporte_ventas/reporte_ventas.php"><h3>Reporte Ventas</h3></a>
            </div>
            <div class="menu-a">
                <a href="../inventario/inventario.php"><h3>Inventario</h3></a>
            </div>
            <div class="menu-a">
                <a href="../pedidos/pedidos.php"><h3>Pedidos</h3></a>
            </div>
            <div class="menu-b"><h3>Salir</h3></div>
        </div>
        <!-- Desde aqui se puede modificar para otros modulos -->
        <div class="cuerpo">
            <div class="modulo-informacion">
                <div class="subtitul">
                    <h3>Informacion basica sobre el usuario</h3>
                </div>
                <div class="perfil">
                    <div  class="circulo"></div>
                </div>
                <div class="informacion">
                    <div class="dat">ID usuario: 
                        <b><?=htmlspecialchars($usuario['id_usuario']) ?></b>
                    </div>
                    <div class="dat">Nombre de usuario: 
                        <b><?=htmlspecialchars($usuario['username']) ?></b>
                    </div>
                    <div class="dat">Nombre: 
                       <b> <?=htmlspecialchars($usuario['nombre_p']) ?></b>
                    </div>
                    <div class="dat">Apellido: 
                        <b><?=htmlspecialchars($usuario['apellido_p']) ?></b>
                    </div>
                    <div class="dat">Telefono: 
                        <b><?=htmlspecialchars($usuario['telefono_p']) ?></b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>