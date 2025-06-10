<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/globalStyle.css">
    <link rel="stylesheet" href="/public/css/btn_actualizarInventario.css">

    <title>Actualizar Inventario</title>
</head>

<body>
    <!-- Interfaz Para pantallas pequeñas -->
    <div class="encabezado-mvl">
        <div class="cl-titulo">
            <h3 class="titulo-mvl">ADMINISTRADOR</h3>
        </div>
        <div class="img-menu">
            <img src="/public/img/file.png" alt="">

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
                <a href="../../../../logout.php"><h3>Salir</h3></a>
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
                <a href="../../../logout.php"><h3>Salir</h3></a>
            </div>
        </div>
        <!-- Desde aqui se puede modificar para otros modulos -->
        <div class="Act_Invetario-body">
            <div class="Act_Inventario-main-body">
                <div class="Act_Inventario-upper-body">
                    
                </div>
                <div class="Act_Inventario-lower-body">
                    <div class="actualizar-inventario">
                        <div class="titulo-actualizarInv">
                            <h3>Actualizar Inventario</h3>
                        </div>
                        <div class="conten-actualizarInv">
                            <!-- Los Productos deben aparecer automaticamente, 
                            mas no agregarlos manualmente -->
                            <!-- Prueba de componente PRODUCTO -->
                            <div class="producto_actu" >
                                <div class="nomb_act_prod">
                                    <h3>Pan de trigo</h3>
                                </div>
                                <div class="datos_act_prod">
                                    <div class="cant_act_prod">
                                        <!-- Cantidad actual del producto -->
                                        <h4>Cantidad actual: 0</h4>
                                    </div>
                                    <div class="cant_a_actualizar">
                                        <label for=""><h4>Cantidad a actualizar</h4></label> 
                                        <input type="number" placeholder="Cantidad a actualizar" required>
                                    </div>
                                    <div class="cant_act_prod">
                                        <!-- Cantidad total del producto CA + ACTU  -->
                                        <!-- La suma debe realizarce en tiempo real -->
                                        <h4>Cantidad total: 56</h4>
                                    </div>
                                    <button>Actualizar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</html>