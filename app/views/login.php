<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once __DIR__ . '/../../config/config.php';
$ipBlocked = $_SESSION['ip_blocked'] ?? false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    <div class="body-login">
        <div class="formulario-login">
            <div class="icono-usuario">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="#fff">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M12 14c-4 0-7 2-7 4v2h14v-2c0-2-3-4-7-4z" />
                </svg>
            </div>
            <div class="titulo-login">
                <h3>Iniciar Sesión</h3>
            </div>
            <div class="content-login">
                <form action="<?= BASE_URL ?>loginProcess" method="post">
                    <input class="input-login" type="text" name="txtusername" placeholder="Nombre de usuario" required <?= $ipBlocked ? 'disabled' : '' ?>>
                    <input class="input-login" type="password" name="txtcontrasenia" placeholder="Contraseña" required <?= $ipBlocked ? 'disabled' : '' ?>>
                    <input class="input-login" type="text" id="txtsucursal" name="txtsucursal" placeholder="Sucursal"
                        readonly <?= $ipBlocked ? 'disabled' : '' ?>>
                    <small style="color: #888; display: block; margin-bottom: 10px;">
                        Este campo (Sucursal) se llena automáticamente al escanear el código QR de la sucursal.
                    </small>
                    <div id="reader" style="width:300px; margin: 0 auto;"></div>
                    <!-- Campo oculto para el id de sucursal -->
                    <button class="boton-login" type="submit" <?= $ipBlocked ? 'disabled' : '' ?>>Iniciar</button>
                </form>
                <?php if (!empty($_SESSION['login_error'])): ?>
                    <div class="mensaje-error">
                        <?= htmlspecialchars($_SESSION['login_error']) ?>
                    </div>
                    <?php unset($_SESSION['login_error']); ?>
                <?php endif; ?>

                <script src="https://unpkg.com/html5-qrcode"></script>

                <!-- Contenedor para el lector QR -->

                <script>
                    function onScanSuccess(decodedText, decodedResult) {
                        // decodedText es el id de la sucursal
                        document.getElementById('txtsucursal').value = decodedText;
                        alert("Sucursal escaneada: " + decodedText);
                        html5QrcodeScanner.clear();
                    }

                    var html5QrcodeScanner = new Html5QrcodeScanner(
                        "reader", {
                        fps: 10,
                        qrbox: 250,
                    });
                    html5QrcodeScanner.render(onScanSuccess);
                </script>
                <script>
                (function(){
                    const ipBlocked = <?= $ipBlocked ? 'true' : 'false' ?>;
                    if (ipBlocked) {
                        const form = document.getElementById('loginForm');
                        form && form.addEventListener('submit', function(e){
                            e.preventDefault();
                        });
                    }
                })();
                </script>
            </div>
        </div>
    </div>
</body>

</html>