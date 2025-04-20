<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Ventas</title>
    <link rel="stylesheet" href="../../../../public/css/globalStyle.css">
    <link rel="stylesheet" href="../../../../public/css/reporte_ventas.css">
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
        <div class="cuerpo-reporteV">
            <div class="encabezado-botones">
                <!-- Boton para visualizar todo el hisotorial de ventas -->
                <div>
                    <button onclick="H_ventas()">Historial de ventas</button>
                </div>
                <!-- Los botones deben aparecer de las sucursales creadas, mas no manualmente -->
                
            </div>
            <div class="principal_contentRV" id="principal_contentRV">
                <div class="content-reporteV">
                    <div class="titulo-reporteV">
                        <h3>Ventas en general del dia</h3>
                    </div>
                    <div class="datos-reporteV">
                        <div class="Cantidad-V">
                            <h4>Cantidad de Ventas</h4><br>
                        </div>
                        <div class="Total-V">
                            <h4>Total de Ventas</h4><br>
                        </div>
                        <div class="Ususarios-R">
                            <h4>Usuarios Registrador</h4><br>
                        </div>
                        <div class="Fecha-RV">
                            <h4>Fecha</h4><br>
                        </div>
                    </div>
                    <div class="campo-bot_bus">
                        <div>
                            <input type="text" name="buscar_ventas" class="buscar_ventas" id="buscar_ventas" placeholder="Buscar por producto o vendedor">
                        </div>
                        <div>
                            <button>Generar PDF</button>
                        </div>
                    </div>
                    <div class="lista-ventas">
                        <table>
                            <!-- Las tablas deben crearse automaticamente al registrarse una venta por los vendedores -->
                            <!-- Este es solo un ejemplo del codigo para las tablas -->
                            <tbody id="tabla_ventas">
                                <tr>
                                    <td colspan="2">
                                        Nombre del producto
                                    </td>
                                    <td>
                                        Nombre del Vendedor
                                    </td>
                                    <td >
                                        Sucursal: ??
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>S/????????</td>
                                    <td>Cantidad:???</td>
                                    <td>Fecha:</td>
                                    <td>Tipo de venta</td>
                                </tr>
                                <!-- Ejemplo -->
                                <tr>
                                    <td colspan="2">
                                        Nombre del producto
                                    </td>
                                    <td>
                                        Nombre del Vendedor
                                    </td>
                                    <td >
                                        Sucursal: ??
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>S/????????</td>
                                    <td>Cantidad:???</td>
                                    <td>Fecha:</td>
                                    <td>Tipo de venta</td>
                                </tr>
                            </tbody>
                                
                            <!-- Ejemplo -->
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        Nombre del producto
                                    </td>
                                    <td>
                                        Nombre del Vendedor
                                    </td>
                                    <td >
                                        Sucursal: ??
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>S/????????</td>
                                    <td>Cantidad:???</td>
                                    <td>Fecha:</td>
                                    <td>Tipo de venta</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../../public/js/main.js"></script>
</body>
</html>