<?php
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../models/us_administrador/informacion/informacionUsuarios.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Pedidos</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/globalStyle.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/pedidos.css">
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
            <div class="mini-menu-b">
                <a href="../../../../logout.php"><h3>Salir</h3></a>
            </div>
        </div>
    </div>
    <!-- Interfaz para pantallas grandes -->
    <div class="content">
        <div class="encabezado">
            <div class="titulo"><h3>ADMINISTRADOR</h3></div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>admin/informacion"><h3>Informacion</h3></a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>admin/sucursales"><h3>Sucursales</h3></a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>admin/usuarios"><h3>Usuarios</h3></a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>admin/reporte_ventas"><h3>Reporte Ventas</h3></a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>admin/inventario"><h3>Inventario</h3></a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>admin/pedidos"><h3>Pedidos</h3></a>
            </div>
            <div class="menu-b">
                <a href="<?= BASE_URL ?>logout"><h3>Salir</h3></a>
            </div>
        </div>
    </div>
        <!-- Desde aqui se puede modificar para otros modulos -->
    <div class="Pe-body">
        <div class="Pe-main-body">
            <div class="Pe-upper-body">
                <div>
                    <button onclick="btn_HPedidos()">Historial de pedidos</button>
                </div>
            </div>
            <div class="Pe-lower-body">
                <div class="cuad-pedidos">
                    <div class="titulo-cuad-pedidos">
                        <h3>Pedidos pendientes</h3>
                    </div>
                    <div class="infor-pedidos">
                        <div class="infor-tbl-pedidos">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nombre del cliente</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Sucursal</th>
                                        <th>Nombre del personal</th>
                                        <th>Fecha registrada</th>
                                        <th>Fecha de entrega</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Juan Pedro</td>
                                        <td>Parta de tartara</td>
                                        <td>1</td>
                                        <td>sucrusal 1</td>
                                        <td>Joel Adriano</td>
                                        <td>3/27/2025</td>
                                        <td>3/30/2025</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
    </div>
        <script src="<?= BASE_URL ?>js/main.js"></script>

</body>
</html>