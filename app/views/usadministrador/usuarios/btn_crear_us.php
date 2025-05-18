<?php
session_start();
require_once __DIR__ . '/../../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuarios</title>
    <link rel="stylesheet" href="../../../../public/css/globalStyle.css">

    <link rel="stylesheet" href="../../../../public/css/btn_crear_us.css">
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
    <?php if (isset($_SESSION['error'])): ?>
                        <p style="color: red; text-align:center"><?= $_SESSION['error'] ?></p>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['success'])): ?>
                        <p style="color: green;"><?= $_SESSION['success'] ?></p>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>
    <div class="formulario_usuario">
        <div class="cuerpo-form">
            <div class="titulo-form"> 
                <h3>Datos sobre el usuario</h3>
            </div>
            <div class="from-us">
                <form action="<?= BASE_URL ?>app/controllers/us_administrador/usuarios/crearUsuario.php" method="POST">
                    <div>
                        <label for="txtnombre">Nombre</label><br>
                        <input type="text" name="txtnombre_p" placeholder="Nombre" required>
                    </div>
                    <div>
                        <label for="">Apellido</label><br>
                        <input type="text" name="txtapellido_p" placeholder="Apellido" required>
                    </div>
                    <div>
                        <label for="">DNI</label><br>
                            <input type="number" name="txtdni_p" placeholder="DNI" required>
                    </div>
                    <div>
                        <label for="">Telefono</label><br>
                            <input type="number" name="txttelefono_p" placeholder="Telefono" required>
                    </div>
                    <div>
                        <label for="">Correo electronico</label><br>
                            <input type="text" name="txtcorreo_p" placeholder="Correo Electronico">
                    </div>
                    <div>
                        <label for="txtroll_p">Roll</label><br>
                        <select name="txtroll_p" id="txtroll_p" required>
                            <option value="administrador">Administrador</option>
                            <option value="vendedor">Personal</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit">Crear Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>