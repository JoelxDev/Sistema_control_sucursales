<?php
// filepath: c:\xampp\htdocs\WebSistemC_P\app\controllers\us_admistrador\craerSucursal.php

session_start();
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../models/us_administrador/sucursales/modelSucursal.php';

// Validar sesión y rol
if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header('Location: ' . BASE_URL . 'public/index.php');
    exit;
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar datos del formulario
    $nombre_s = trim($_POST['txtnombre_s'] ?? '');
    $ubicacion_s = trim($_POST['txtubicacion_s'] ?? '');
    $estado_s = trim($_POST['txtestado_s'] ?? '');
    $ciudad_s = trim($_POST['txtciudad_s'] ?? '');
    // $telefono_s = trim($_POST['txttelefono_s'] ?? '');

    if (empty($nombre_s) || empty($ubicacion_s) || empty($ciudad_s) || empty($estado_s)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header('Location: ' . BASE_URL . 'app/views/usadministrador/sucursales/anadir_sucursal.php');
        exit;
    }

    // Crear sucursal
    if (Sucursal::crear($nombre_s, $ubicacion_s, $estado_s, $ciudad_s )) {
        $_SESSION['success'] = "Sucursal creada exitosamente.";
    } else {
        $_SESSION['error'] = "Error al crear la sucursal. Inténtalo nuevamente.";
    }
    // Redirigir al formulario
    header('Location: ' . BASE_URL . 'app/views/usadministrador/sucursales/anadir_sucursal.php');
    exit;
}
?>