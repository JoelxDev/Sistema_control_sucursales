<?php
    require_once __DIR__ . '/../../config/config.php'; 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>login.css">
</head>
<body>
    <div class="body-login">
        <div class="formulario-login">
            <div class="titulo-login">
                <h3>Iniciar Sesion</h3>
            </div>
            <div class="content-login">
                <form action="<?= BASE_URL ?>validationLogin.php" method="post">
                        <input type="text" name="txtusername" placeholder="Nombre de usuario" required>
                        <input type="password" name="txtcontrasenia" placeholder="Contraseña" required>
                        <input type="text" name="txtsucursal" placeholder="Sucursal" >
                    <button type="submit">Iniciar</button>
                </form>
                <?php if (!empty($_SESSION['login_error'])): ?>
    <div style="color:red;">
        <?= htmlspecialchars($_SESSION['login_error']) ?>
    </div>
    <?php unset($_SESSION['login_error']); ?>
<?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>