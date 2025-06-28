<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/globalStyle.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/pedidosUE.css">
    <title>Pedidos</title>
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
                <a href="../informacionUE/informacionUE.php">
                    <h3>Informacion</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="../registrarVentaUE/registrarVentaUE.php">
                    <h3>Registrar Venta</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="../inventarioUE/inventarioUE.php">
                    <h3>Inventario</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="../pedidosUE/pedidosUE.php">
                    <h3>Pedidos</h3>
                </a>
            </div>
            <div class="mini-menu-b">
                <a href="../../../../logout.php">
                    <h3>Salir</h3>
                </a>
            </div>
        </div>
    </div>
    <!-- Interfaz para pantallas grandes -->
    <div class="content">
        <div class="encabezado">
            <div class="titulo">
                <h3>Joel</h3>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>usuario/perfil">
                    <h3>Informacion</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>usuario/ventas">
                    <h3>Registrar Venta</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>usuario/inventario">
                    <h3>Inventario</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>usuario/pedidos">
                    <h3>Pedidos</h3>
                </a>
            </div>

            <div class="menu-b">
                <a href="<?= BASE_URL ?>logout">
                    <h3>Salir</h3>
                </a>
            </div>
        </div>
    </div>
    <!-- Desde aqui se puede modificar para otros modulos -->
    <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
        <div id="mensaje-flotante" style="position:fixed;top:20px;right:20px;z-index:9999;
                padding:15px 25px;border-radius:6px;
                color:#fff;
                background:<?= isset($_SESSION['success']) ? '#28a745' : '#dc3545' ?>;
                box-shadow:0 2px 8px rgba(0,0,0,0.15);">
            <?= isset($_SESSION['success']) ? $_SESSION['success'] : $_SESSION['error'] ?>
        </div>
        <script>
            setTimeout(() => {
                const msg = document.getElementById('mensaje-flotante');
                if (msg) msg.style.display = 'none';
            }, 3000);
        </script>
        <?php unset($_SESSION['success'], $_SESSION['error']); ?>
    <?php endif; ?>
    <div class="PED-body">
        <div class="PED-main-body">
            <div class="PED-uppder-body">
                <div class="btn_lista_pedid">
                    <button onclick="btn_listaPedidosUE()">Lista de pedidos</button>
                </div>
            </div>
            <div class="PED-lower-body">
                <div class="regis-pedidos">
                    <div class="titul-regist-ped">
                        <h3>Registrar pedido</h3>
                    </div>
                    <div class="form-regist-ped">
                        <input type="text" placeholder="Nombre del cliente"><br>
                        <input type="text" placeholder="Nombre del Producto"><br>
                        <input type="text" placeholder="Cantidad"><br>
                        <input type="text" placeholder="Fecha y hora de entrega"><br>
                        <div>
                            <button>Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="/public/js/main.js"></script>
</body>

</html>