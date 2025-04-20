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
            <div class="encabezado-modulo">
                <div>
                    <input type="text" name="buscar_usuario" class="buscar_usuario" id="buscar_usuarios" placeholder="Buscar por nombre">
                </div>
                <div>
                    <button class="button-crearU" onclick="C_usuarios()" >Crear usuarios</button>
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
                                <th>Username</th>
                                <th>Primer Nombre</th>
                                <th>Primer Apellido</th>
                                <th>Tipo Usuario</th>
                                <th>Roll</th>
                                <th>Telefono</th>
                                <th colspan="3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>jose01</td>
                                <td>Jose</td>
                                <td>Quispe</td>
                                <td>Administrador</td>
                                <td>Administrador</td>
                                <td>946513200</td>
                                <td class="bott"><button>Editar</button></td>
                                <td class="bott"><button>Eliminar</button></td>
                                <td class="bott"><button>M.Inf</button></td>
                            </tr>
                            <tr>
                                <!-- Para una nueva lista de datos, crear un nuevo 'tr' -->
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="/public/js/main.js"></script>

</body>
</html>