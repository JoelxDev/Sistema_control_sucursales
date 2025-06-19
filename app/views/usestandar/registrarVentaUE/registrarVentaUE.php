<?php
require_once __DIR__ . '/../../../models/us_estandar/registrarVentasUE/modelRegistrarVentasUE.php';
require_once __DIR__ . '/../../../../config/config.php';
$productos = ProductosVenta::obtenerTodos();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/globalStyle.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/registrarVentasUE.css">

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
                            <form action="<?= BASE_URL ?>app/controllers/us_estandar/registrarVentaUE/registrarVentaUE.php" method="post">
                                <div>
                                    <label for="tipo_venta">Tipo de venta</label>
                                    <select name="txttipo_venta" id="tipo_venta" required>
                                        <option value="Unico">Unico</option>
                                        <option value="Mixta">Mixta</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="nom_producto">Nombre del Producto</label><br>
                                    <select name="txtnom_producto" id="nom_producto" required onchange="mostrarPrecio()">
                                        <option value="">Seleccione un producto</option>
                                        <?php foreach ($productos as $producto): ?>
                                            <option value="<?= htmlspecialchars($producto['id_producto']) ?>"
                                                data-precio="<?= htmlspecialchars($producto['precio_unitario_pr']) ?>">
                                                <?= htmlspecialchars($producto['nombre_pr']) ?>
                                                <?= htmlspecialchars($producto['precio_unitario_pr']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="cantidad">Cantidad</label><br>
                                    <input type="number" name="txtcantidad" id="cantidad" min="1"  required>
                                </div>
                                <div>
                                    <label for="precio_unitario">Precio unitario</label><br>
                                    <input type="number" name="txtprecio_unitario" id="precio_unitario" step="0.01"
                                        required>
                                </div>
                                <div>
                                    <label for="total">Total</label><br>
                                    <input type="number" step="any" name="txttotal" id="total" step="0.01" required>
                                </div>
                                <div>
                                    <label for="metod_pago">Metodo de pago</label><br>
                                    <select name="txtmetodo_pago" id="metodo_pago" required>
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Digital">Digital</option>
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
        <script>
function mostrarPrecio() {
    const select = document.getElementById('nom_producto');
    const precio = select.options[select.selectedIndex].getAttribute('data-precio');
    document.getElementById('precio_unitario').value = precio ? precio : '';
    calcularTotal();
}
document.getElementById('cantidad').addEventListener('input', calcularTotal);
document.getElementById('nom_producto').addEventListener('change', calcularTotal);

function calcularTotal() {
    const precio = parseFloat(document.getElementById('precio_unitario').value) || 0;
    const cantidad = parseInt(document.getElementById('cantidad').value) || 0;
    document.getElementById('total').value = (precio * cantidad).toFixed(2);
}
</script>
        <script src="/public/js/main.js"></script>
</body>

</html>