<?php
session_start();
require_once __DIR__ . '/../../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Producto</title>
    <link rel="stylesheet" href="../../../../public/css/globalStyle.css">
    <link rel="stylesheet" href="../../../../public/css/btn_AProducto.css">

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
     <?php if (isset($_SESSION['error'])): ?>
                        <p style="color: red; text-align:center"><?= $_SESSION['error'] ?></p>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['success'])): ?>
                        <p style="color: green;"><?= $_SESSION['success'] ?></p>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>
    <div class="AP-body">
        <div class="AP-main-body">
            <div class="AP-upper-body">
                <!-- No hay contenido -->
            </div>
            <div class="AP-lower-body">
                <div class="formulario-AP">
                    
                    <form action="<?= BASE_URL ?>app/controllers/us_administrador/inventario/crearProducto.php" method="post">
                        <div class="titulo-formulario-AP">
                        <h3>Detalles del Producto a registrar</h3>
                    </div>
                    <div class="datos-formulario-AP">
                        <div>
                            <label for="txtnombre_pr">Nombre del Producto</label><br>
                            <input type="text" name="txtnombre_pr" id="txtnombre_pr" placeholder="Nombre del Producto" required>
                        </div>
                        <div>
                            <label for="txtdescripcion_pr">Descripcion</label><br>
                            <input type="text" name="txtdescripcion_pr" id="txtdescripcion_pr" placeholder="Descripcion" required>
                        </div>
                        <div>
                            <label for="txtprecio_pr">Precio Unitario</label><br>
                            <input type="number" name="txtprecio_pr" id="txtprecio_pr" placeholder="Precio Unitario" required>
                        </div>
                        <div>
                            <label for="txtunidades_pr">Unidades</label><br>
                            <input type="number" name="txtunidades_pr" id="txtunidades_pr" placeholder="Unidades" required>
                        </div>
                        <div>
                            <label for="txtcaregoria">Categoria</label><br>
                            <input type="text" name="txtcategoria_pr" id="txtcategoria_pr" placeholder="Categoria" required>
                        </div>
                        <div>
                            <button type="submit">Registrar</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>