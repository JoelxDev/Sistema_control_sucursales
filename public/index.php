<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="body-login">
        <div class="formulario-login">
            <div class="titulo-login">
                <h3>Iniciar Sesion</h3>
            </div>
            <div class="content-login">
                <form action="../app/models/login.php" method="post">
                        <input type="text" name="txtusername" placeholder="Nombre de usuario" required>
                        <input type="password" name="txtcontrasenia" placeholder="Contraseña" required>
                    <button type="submit">Iniciar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>