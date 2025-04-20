<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucursales</title>
    <link rel="stylesheet" href="../../../../public/css/globalStyle.css">

    <link rel="stylesheet" href="../../../../public/css/sucursal.css">
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
        <div class="cuerpo-S">
            <div class="boton-sucursal">
                <button class="anadir-sucursal"  onclick="A_sucursal() ">Añadir Sucursal</button>
            </div>
            <!-- Este es el modulo para crear las sucursales RECUERDA QUE ESTOS DATOS SE DEBEN JALAR DEL FORMULARIO AL AÑADIR_SUCURSAL-->
            <div class="modulos-sucursales">
                <div id="cont-sucursal">
                    <div class="titulo-S">
                        <h3>Sucursal N°1</h3>
                    </div>
                    <div class="datos-sucursal">
                        <div class="ubicacion-S">
                            Jr. Tumbes/Cabana <br>
                        </div>
                        <div class="ciudad-S">
                            Ciudad
                        </div>
                        <div class="estado-S">
                            <label for="estado">Estado</label><br>
                            <select name="estado" id="estado">
                                <option value="">
                                    Activo
                                </option>
                                <option value="">
                                    Inactivo 
                                </option>
                            </select>
                        </div>
                        <div class="botones-S">
                            <button class="modificar-btn">Modificar</button>
                            <button class="eliminar-btn">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../../public/js/main.js"></script>
</body>
</html>