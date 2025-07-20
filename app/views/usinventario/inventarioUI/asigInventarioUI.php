<?php
// session_start();
require_once __DIR__ . '/../../../../config/config.php';

require_once __DIR__ . '/../../../models/us_inventario/informacionUI/informacionUI.php';
require_once __DIR__ . '/../../../models/us_inventario/inventarioUI/modelInventarioUI.php';

$id_usuario = $_SESSION['id_usuario'] ?? null;
if (!$id_usuario) {
    // Si no hay sesión, redirige al login
    header('Location: ' . BASE_URL . 'public/');
    exit;
}
$productos = ModelInventario::obtenerProductos();
$sucursales = ModelInventario::obtenerSucursales();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Inventario</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/globalStyle.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/asigInventario.css">
</head>

<body>
    <!-- Interfaz Para pantallas pequeñas -->
    <div class="encabezado-mvl">
        <div class="cl-titulo">
            <h3 class="titulo-mvl">INVENTARIADO</h3>
        </div>
        <div class="img-menu">
            <img src="<?= BASE_URL ?>/img/file.png" alt="">

        </div>

    </div>
    <div class="mini-content"> 
        <div class="mini-encabezado">
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>inv/informacion"><h3>Informacion</h3></a>
            </div>
            <div class="mini-menu-a">
                <a href="<?= BASE_URL ?>inv/inventario"><h3>Inventario</h3></a>
            </div>
            <div class="mini-menu-b">
                <a href="<?= BASE_URL ?>logout"><h3>Salir</h3></a>
            </div>
        </div>
    </div>
    <!-- Interfaz para pantallas grandes -->
    <div class="content">
        <div class="encabezado">
            <div class="titulo">
                <h3>INVENTARIADO: </h3>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>inv/informacion">
                    <h3>Informacion</h3>
                </a>
            </div>
            <div class="menu-a">
                <a href="<?= BASE_URL ?>inv/inventario">
                    <h3>Inventario</h3>
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
            <div class="main-body">
                    <div class="upper-body">
                        <div>
                            <button onclick="btn_historialAsigUI()">Historial de asignaciones</button>
                        </div>
                    </div>
                    <div class="lower-body">
                        <div class="form-inventario">
                            <div class="subtitulo">
                                <h3>Asignar Inventariado</h3>
                            </div>
                            <form action="<?= BASE_URL ?>inv/inventario/asigInventario" method="post">
                                    <label for="txttipoasigInv">Tipo de asignacion</label>
                                    <select name="txttipoasigInv" id="txttipoasigInv" required>
                                        <option value="entrada">Entrada</option>
                                    </select><br>
                                    <label for="txtepocaInv">Epoca o N° de entrada</label>
                                    <select name="txtepocaInv" id="txtepocaInv" required>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                    </select><br>
                                    <label for="txtproductoInv">Seleccione el producto</label>
                                    <select name="txtproductoInv" id="txtproductoInv" required>
                                        <option value="">Seleccione un producto</option>
                                        <?php foreach ($productos as $producto): ?>
                                            <option value="<?= $producto['id_producto'] ?>">
                                                <?= htmlspecialchars($producto['nombre_pr']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select><br>
                                    <label for="txtsucursalInv">Seleccione la sucursal</label>
                                    <select name="txtsucursalInv" id="txtsucursalInv" required>
                                        <option value="">Seleccione una sucursal</option>
                                        <?php foreach ($sucursales as $sucursal): ?>
                                            <option value="<?= $sucursal['id_sucursal'] ?>">
                                                <?= htmlspecialchars($sucursal['nombre_s']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select><br>
                                    <label for="txtcantidadInv">Cantidad</label>
                                    <input type="number" name="txtcantidadInv" id="txtcantidadInv"
                                        placeholder="Ingrese la cantidad" required><br>
                                    <button type="submit">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
        <script src="<?= BASE_URL ?>js/main.js"></script>
</body>
</html>