<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
    require_once __DIR__ . '/../../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/login.css">
</head>

<body>
    <div class="body-login">
        <div class="formulario-login">
            <div class="icono-usuario">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="#fff">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M12 14c-4 0-7 2-7 4v2h14v-2c0-2-3-4-7-4z"/>
                </svg>
            </div>
            <div class="titulo-login">
                <h3>Iniciar Sesión</h3>
            </div>
            <div class="content-login">
                <form action="<?= BASE_URL ?>loginProcess" method="post">
                    <input class="input-login" type="text" name="txtusername" placeholder="Nombre de usuario" required>
                    <input class="input-login" type="password" name="txtcontrasenia" placeholder="Contraseña" required>
                    <input class="input-login" type="text" name="txtsucursal" placeholder="Sucursal">
                    <button class="boton-login" type="submit">Iniciar</button>
                </form>
                <?php if (!empty($_SESSION['login_error'])): ?>
                    <div class="mensaje-error">
                        <?= htmlspecialchars($_SESSION['login_error']) ?>
                    </div>
                    <?php unset($_SESSION['login_error']); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>