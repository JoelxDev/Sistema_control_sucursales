<?php
require_once __DIR__ . '/../../../models/us_administrador/sucursales/modelSucursal.php';
require_once __DIR__ . '/../../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
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
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        error_log(date('[Y-m-d H:i:s] ') . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/../../../../logs/error.log');
    }
    header('Location: ' . BASE_URL . 'admin/sucursales');
    exit;
}
?>