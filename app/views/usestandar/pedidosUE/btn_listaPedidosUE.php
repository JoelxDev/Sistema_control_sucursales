<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/globalStyle.css">
    <link rel="stylesheet" href="/css/pedidosUE.css">
    <title>Lista de pedidos</title>
</head>
<body>
        <!-- Interfaz Para pantallas pequeñas -->
        <div class="encabezado-mvl">
            <div class="cl-titulo">
                <h3 class="titulo-mvl">SUCURSAL</h3>
            </div>
            <div class="img-menu">
            <img src="<?= BASE_URL ?>/img/file.png" alt="">
            </div>
            
        </div>
        <div class="mini-content"> 
        <div class="mini-encabezado">
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>usuario/perfil"><h3>Informacion</h3></a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>usuario/ventas"><h3>Registrar Venta</h3></a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>usuario/inventario"><h3>Inventario</h3></a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>usuario/pedidos"><h3>Pedidos</h3></a>
            </div>
            <div class="mini-menu-b">
                <a href="<?= BASE_URL ?>logout"><h3>Salir</h3></a>
            </div>
        </div>
    </div>
        <!-- Interfaz para pantallas grandes -->
        <div class="content">
            <div class="encabezado">
            <div class="titulo"><h3>Joel</h3></div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>usuario/perfil"><h3>Informacion</h3></a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>usuario/ventas"><h3>Registrar Venta</h3></a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>usuario/inventario"><h3>Inventario</h3></a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>usuario/pedidos"><h3>Pedidos</h3></a>
            </div>

            <div class="menu-b">
                <a href="<?= BASE_URL ?>logout"><h3>Salir</h3></a>
            </div>
        </div>
            </div>
            <!-- Desde aqui se puede modificar para otros modulos -->
            <div>
                <h1>Aun no hay contenido</h1>
            </div>
        </div>
    <script src="/js/main.js"></script>

</body>
</html>