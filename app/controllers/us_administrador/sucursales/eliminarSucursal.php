<?php
session_start();
require_once __DIR__ . '/../../../models/us_administrador/sucursales/modelSucursal.php';
require_once __DIR__ . '/../../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_sucursal = $_POST['id_sucursal'] ?? null;

    if ($id_sucursal && Sucursal::eliminar($id_sucursal)) {
        $_SESSION['success'] = "Sucursal eliminada exitosamente.";
    } else {
        $_SESSION['error'] = "Error al eliminar la sucursal.";
    }

    header('Location: ' . BASE_URL . 'app/views/usadministrador/sucursales/sucursales.php');
    exit;
}
?>