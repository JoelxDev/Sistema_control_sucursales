<?php
require_once __DIR__ . '/../../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/globalStyle.css">
    <link rel="stylesheet" href="/css/registrarVentasUE.css">

    <title>Registrar Venta</title>
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
                <a href="<?= BASE_URL ?>usuario/perfil">
                    <h3>Informacion</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>usuario/ventas">
                    <h3>Registrar Venta</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>usuario/inventario">
                    <h3>Inventario</h3>
                </a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>usuario/pedidos">
                    <h3>Pedidos</h3>
                </a>
            </div>
            <div class="mini-menu-b">
                <a href="<?= BASE_URL ?>logout">
                    <h3>Salir</h3>
                </a>
            </div>
        </div>
    </div>
    <!-- Interfaz para pantallas grandes -->
    <div class="content">
        <div class="encabezado">
            <div class="titulo">
                <h3>SUCURSAL</h3>
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
        <div class="cuerpo">
            <div class="reg-venta-main-body">
                <div class="upper-body">
                    <div class="btn_ventas-registradas">
                        <button onclick="btn_ventasRegistradasUE()">Ventas registradas</button>
                    </div>
                </div>
                <div class="lower-body">
                    <div class="formulario-registro-venta">
                        <div class="subtitulo">
                            <h3>Formulario de ventas</h3>
                        </div>
                        <div class="entrada-datos">
                            <form action="<?= BASE_URL ?>usuario/registrarVenta" method="post">
                                <div>
                                    <label for="tipo_venta">Tipo de venta</label>
                                    <select name="txttipo_venta" id="tipo_venta" required>
                                        <option value="Unico">Unico</option>
                                        <!-- <option value="Mixta">Mixta</option> -->
                                    </select>
                                </div>
                                <div class="datos-producto">
                                    <div>
                                        <label for="nom_producto">Nombre del Producto</label><br>

                                        <select name="txtnom_producto" id="nom_producto" required onchange="mostrarPrecio()">
                                            <option value="">Seleccione un producto</option>
                                            <?php foreach ($productosDisponibles as $producto): ?>
                                                <option value="<?= htmlspecialchars($producto['id_producto']) ?>"
                                                    data-precio="<?= htmlspecialchars($producto['precio_unitario_pr']) ?>">
                                                    <?= htmlspecialchars($producto['nombre_pr']) ?> (Hay: <?= htmlspecialchars($producto['cantidad_in']) ?> U.)
                                                </option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                    <div>
                                        <label for="precio_unitario">Precio unitario</label><br>
                                        <input type="number" name="txtprecio_unitario" id="precio_unitario" step="0.01" placeholder="Precio Unitario" required>
                                    </div>
                                    <div>
                                        <label for="cantidad">Cantidad</label><br>
                                        <input type="number" name="txtcantidad" id="cantidad" min="1" placeholder="Cantidad" required>
                                    </div>
                                    <div>
                                        <label for="subtotal">Sub Total</label><br>
                                        <input type="number" name="txtsubtotal" id="subtotal" min="0" step="0.01" placeholder="Sub Total">
                                    </div>
                                </div>
                        </div>
                        <div>
                            <label for="total">Total</label><br>
                            <input type="number" step="any" name="txttotal" id="total" step="0.01" placeholder="Total" required>
                        </div>
                        <div>
                            <label for="metod_pago">Metodo de pago</label><br>
                            <select name="txtmetodo_pago" id="metodo_pago" required>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Digital">Digital</option>
                            </select>
                        </div>
                        <div class="boton">
                            <button type="submit" class="btn-registrar">Registrar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Referencias a elementos
        const cantidadEl = document.getElementById('cantidad');
        const nomProductoEl = document.getElementById('nom_producto');
        const precioEl = document.getElementById('precio_unitario');
        const subtotalEl = document.getElementById('subtotal');
        const totalEl = document.getElementById('total');

        function calcularSubtotal() {
            const precio = parseFloat(precioEl.value) || 0;
            const cantidad = parseFloat(cantidadEl.value) || 0;
            const subtotal = precio * cantidad;
            subtotalEl.value = subtotal.toFixed(2);
            return subtotal;
        }

        function calcularTotal() {
            const subtotal = parseFloat(subtotalEl.value) || 0;
            totalEl.value = subtotal.toFixed(2);
        }

        function mostrarPrecio() {
            const select = document.getElementById('nom_producto');
            const precio = select.options[select.selectedIndex].getAttribute('data-precio');
            precioEl.value = precio ? precio : '';
            calcularSubtotal();
            calcularTotal();
        }

        // Listeners: recalcular subtotal y total al cambiar cantidad o producto
        if (cantidadEl) {
            cantidadEl.addEventListener('input', () => {
                calcularSubtotal();
                calcularTotal();
            });
        }
        if (nomProductoEl) {
            nomProductoEl.addEventListener('change', () => {
                mostrarPrecio();
            });
        }

        // Inicializar valores si ya hay selección/valor al cargar
        document.addEventListener('DOMContentLoaded', () => {
            if (nomProductoEl && nomProductoEl.value) mostrarPrecio();
            else calcularSubtotal(), calcularTotal();
        });
    </script>
    <script src="/js/main.js"></script>

</body>

</html>