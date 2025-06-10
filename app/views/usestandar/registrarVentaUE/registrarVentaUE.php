<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../public/css/globalStyle.css">
    <link rel="stylesheet" href="../../../../public/css/registrarVentasUE.css">

    <title>Registrar Venta</title>
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
                <a href="../informacionUE/informacionUE.php">
                    <h3>Informacion</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="../registrarVentaUE/registrarVentaUE.php">
                    <h3>Registrar Venta</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="../inventarioUE/inventarioUE.php">
                    <h3>Inventario</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="../pedidosUE/pedidosUE.php">
                    <h3>Pedidos</h3>
                </a>
            </div>

            <div class="menu-b">
                <a href="../../../logout.php">
                    <h3>Salir</h3>
                </a>
            </div>
        </div>
        <!-- Desde aqui se puede modificar para otros modulos -->
        <div class="reg-venta-body">
            <div class="reg-venta-main-body">
                <div class="reg-venta-upper-bodyf">
                    <div class="btn_ventas-registradas">
                        <button onclick="btn_ventasRegistradasUE()">Ventas registradas</button>
                    </div>
                </div>
                <div class="reg-venta-lower-body">
                    <div class="formulario-registro-venta">
                        <div class="titulo-formulario-rv">
                            <h3>Formulario de ventas</h3>
                        </div>
                        <div class="entrada-datos">
                            <form action="../../../controllers/usestandar/registrarVentaUE.php" method="post">
                                <div>
                                    <label for="tipo_venta">Tipo de venta</label>
                                    <select name="tipo_venta" id="tipo_venta" required>
                                        <option value="Normal">Normal</option>
                                        <option value="Mixta">Mixta</option>
                                        <option value="Multiple">Multiple</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="nom_producto">Nombre del Producto</label><br>
                                    <select name="nom_producto" id="nom_producto" required>
                                        <!-- Aquí deberías cargar los productos desde la base de datos -->
                                        <option value="1">Pan de harina</option>
                                        <option value="2">Torta</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="cantidad">Cantidad</label><br>
                                    <input type="number" name="cantidad" id="cantidad" min="1" required>
                                </div>
                                <div>
                                    <label for="precio_unitario">Precio unitario</label><br>
                                    <input type="number" name="precio_unitario" id="precio_unitario" step="0.01"
                                        required>
                                </div>
                                <div>
                                    <label for="total">Total</label><br>
                                    <input type="number" name="total" id="total" step="0.01" required>
                                </div>
                                <div>
                                    <label for="metod_pago">Metodo de pago</label><br>
                                    <select name="metod_pago" id="metod_pago" required>
                                        <option value="Digital">Digital</option>
                                        <option value="Efectivo">Efectivo</option>
                                    </select>
                                </div>
                                <div class="btn-registrarV">
                                    <button type="submit">Registrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/public/js/main.js"></script>
</body>

</html>