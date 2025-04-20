<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="stylesheet" href="../../../../public/css/globalStyle.css">
    <link rel="stylesheet" href="../../../../public/css/inventario.css">
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
        <div class="cuerpo-inventario">
            <div class="botones-inventario" id="btn_inventario">
                <div>
                    <button onclick="btn_VProductos()">Producto</button>
                </div>
                <!-- Los botones de las sucursales deben aparecer
                automaticamente, mas no crearlos manualmente -->

            </div>
            <div class="inventario">
                <div class="informacion-inventario">
                    <div class="titulo-inventario">
                        <h3>Actualizar Inventario</h3>
                    </div>
                    <div class="cont-inventario">
                        <div class="cont-superior">
                            <div>
                                <label for="tipo_actualizacion">Tipo de actualizacion</label>
                                    <select name="tipo_actualizacion" id="tipo_actualizacion">
                                    <!-- Las sucursales deben aparecer automaticamente -->
                                    <option value="">En general</option>
                                </select>
                            </div>
                        </div>
                        <div class="cont-inferior">
                            <div class="cont-enviar">
                                <div class="nomb-producto">
                                    <label for="nomb_producto">Nombre del Producto</label>
                                    <select name="nomb_producto" id="nomb_producto">
                                        <!-- Se debe mostrar automaticamente los nombres
                                        de los productos, mas no manualmente -->
                                        <option value="">Nombre del producto</option>
                                    </select>
                                </div>
                                <!-- Los campos para rellenar las cantidades enviadas, 
                                deben aparecer automaticamente al usuario segun la cantidad de productos creados
                                MAS NO MANUALMENTE -->
                                <!-- Ejemplo del diseño del campo ara rellenar las cantidades enviadas  -->
                                <div class="cantidad-inventario">
                                    <label for="">Cantidad Enviada</label>
                                    <input type="number" name="" placeholder="0">
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="../../../../public/js/main.js"></script>

</body>
</html>