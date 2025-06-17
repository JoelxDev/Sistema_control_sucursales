<?php
require_once __DIR__ . '/../../../models/us_administrador/sucursales/modelSucursal.php';
require_once __DIR__ . '/../../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_sucursal = $_POST['id_sucursal'] ?? null;
    $nombre_s = $_POST['nombre_s'] ?? '';
    $ubicacion_s = $_POST['ubicacion_s'] ?? '';
    $estado_s = $_POST['estado_s'] ?? '';
    $ciudad_s = $_POST['ciudad_s'] ?? '';

    if ($id_sucursal && Sucursal::editar($id_sucursal, $nombre_s, $ubicacion_s, $estado_s, $ciudad_s)) {
        $_SESSION['success'] = "Sucursal editada exitosamente.";
    } else {
        $_SESSION['error'] = "Error al editar la sucursal.";
    }

    header('Location: ' . BASE_URL . 'admin/sucursales');
    exit;
}
?>