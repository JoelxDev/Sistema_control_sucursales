<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="../../../../public/css/globalStyle.css">
    <link rel="stylesheet" href="../../../../public/css/btn_VProductos.css">

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
    <div class="cuerpo-VProductos" id="cuerpo_VProductos">
            <div class="principal-contentBVP">
                <div class="cuerpo-superior">
                    <div>
                        <button class="btn_añadirP" onclick="btn_AProducto()" >Añadir producto</button>
                    </div>
                    
                </div>
                <div class="cuerpo-inferior">
                    <div class="titulo-VProductos">
                        <h3>Productos registrados en el inventario</h3>
                    </div>
                    <div class="tabla-VProductos">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID PRODUCTO</th>
                                    <th>NOMBRE DEL PRODUCTO</th>
                                    <th>CATEGORIA</th>
                                    <th>DESCRIPCION</th>
                                    <th>PRECIO UNITARIO</th>
                                    <th colspan="3">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>0001</td>
                                    <td>Pan integral</td>
                                    <td>Panes</td>
                                    <td>Pan hecho a base de trigo</td>
                                    <td>S/. 0.5</td>
                                    <td>
                                        <button>Editar</button>
                                        <button>Eliminar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    <script src="../../../../public/js/main.js"></script>
</body>
</html>