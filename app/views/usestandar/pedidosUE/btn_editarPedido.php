<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/globalStyle.css">
    <link rel="stylesheet" href="/css/pedidosUE.css">
    <title>Pedidos</title>
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
            <div class="PED-main-body">
                <div class="upper-body">
                    <div class="btn_lista_pedid">
                        <a href="<?= BASE_URL ?>usuario/pedidos/listaPedidos"><button>Lista Pedidos</button></a>
                        <!-- <button onclick="btn_listaPedidosUE()">Lista de pedidos</button> -->
                    </div>
                </div>
                <div class="lower-body">
                    <div class="regis-pedidos">
                        <div class="subtitulo">
                            <h3>Registrar pedido</h3>
                        </div>
                        <div class="form-regist-ped">
                            <form method="POST" action="<?= BASE_URL ?>usuario/pedidos/editar" style="display:grid;gap:10px;max-width:720px;">
                                <input type="hidden" name="id_pedido" value="<?= (int)$pedido['id_pedido'] ?>">

                                <label>Cliente
                                    <input type="text" name="cliente_ped" required value="<?= htmlspecialchars($pedido['cliente_ped'] ?? '') ?>">
                                </label>

                                <label>Producto
                                    <input type="text" name="producto_ped" required value="<?= htmlspecialchars($pedido['producto_ped'] ?? '') ?>">
                                </label>

                                <label>Detalles
                                    <textarea name="detalles_ped" rows="3"><?= htmlspecialchars($pedido['detalles_ped'] ?? '') ?></textarea>
                                </label>

                                <label>Fecha entrega
                                    <input type="datetime-local" name="fecha_entrega" required value="<?= !empty($pedido['fecha_entrega']) ? date('Y-m-d\TH:i', strtotime($pedido['fecha_entrega'])) : '' ?>">
                                </label>

                                <label>Pago adelanto
                                    <input type="number" step="0.01" min="0" name="pago_adelanto" value="<?= number_format((float)($pedido['pago_adelanto'] ?? 0), 2, '.', '') ?>">
                                </label>

                                <label>Pago completado
                                    <input type="number" step="0.01" min="0" name="pago_completado" value="<?= number_format((float)($pedido['pago_completado'] ?? 0), 2, '.', '') ?>">
                                </label>

                                <label>Estado
                                    <select name="estado_ped">
                                        <?php foreach (['pendiente', 'en_proceso', 'completado', 'cancelado'] as $est): ?>
                                            <option value="<?= $est ?>" <?= (($pedido['estado_ped'] ?? '') === $est) ? 'selected' : '' ?>><?= ucfirst(str_replace('_', ' ', $est)) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </label>

                                <div style="display:flex;gap:8px;">
                                    <button type="submit">Guardar cambios</button>
                                    <a href="<?= BASE_URL ?>usuario/pedidos/listaPedidos">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/main.js"></script>
    <script>
        const fe = document.getElementById('fecha_entrega');
        if (fe) fe.min = new Date().toISOString().slice(0, 16);
    </script>
</body>

</html>