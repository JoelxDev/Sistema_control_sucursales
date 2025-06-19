<?php
require_once __DIR__ . '/../../models/modelLogout/modelLogout.php';

// session_start();
if (isset($_SESSION['id_usuario']) && isset($_SESSION['id_sucursal'])) {
    ModelUsuarioSucursal::registrarSalida($_SESSION['id_usuario'], $_SESSION['id_sucursal']);
}

session_unset();
session_destroy();
header('Location: '. '/');
exit;