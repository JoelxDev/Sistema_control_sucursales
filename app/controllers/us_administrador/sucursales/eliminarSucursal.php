<?php
// session_start();
require_once __DIR__ . '/../../../models/us_administrador/sucursales/modelSucursal.php';
require_once __DIR__ . '/../../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id_sucursal = $_POST['id_sucursal'] ?? null;
        if ($id_sucursal && Sucursal::eliminar($id_sucursal)) {
            $_SESSION['success'] = "Sucursal eliminada exitosamente.";
        } else {
            $_SESSION['error'] = "Error al eliminar la sucursal.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        error_log(date('[Y-m-d H:i:s] ') . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/../../../../logs/error.log');
    }
    header('Location: ' . BASE_URL . 'admin/sucursales');
    exit;
}
?>