<?php
session_start();
require_once __DIR__ . '/../config/conexion_db.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/models/us_administrador/sucursales/modelSucursal.php';
require_once __DIR__ . '/../app/models/us_administrador/usuarios/modelUsuarios.php';
require_once __DIR__ . '/../app/models/us_administrador/inventario/modelInventario.php';
$sucursales = Sucursal::obtenerTodas();
$usuarios = Usuarios::obtenerTodosUsuarios();
$productos = Producto::obtenerTodos(); // Asegúrate de que este método exista en tu model

// Rutas limpias base
$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);
$request = trim($request, '/');

// Base de archivos
$base = __DIR__ . '/../app/views/';
$base_c = __DIR__ . '/../app/controllers/';

// Verificar si hay sesión iniciada
$tipo = $_SESSION['tipo_usuario'] ?? null;
$id_usuario = $_SESSION['id_usuario'] ?? null;
$public_routes = ['', 'loginProcess'];

// Si no está logueado, solo permitir acceso al login
if (!$id_usuario && !in_array($request, $public_routes)) {
    header('Location: ' . BASE_URL);
    exit;
}


switch ($request) {
    case '':
        require_once $base . 'login.php';
        break;

    case 'loginProcess':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once $base_c . 'controllerLogin/controllerLogin.php'; // O la ruta de tu controlador de login
        exit;
        } else {
            require_once $base . 'login.php';
        }
    break;

    case 'logout':
        require_once $base_c . 'controllerLogout/controllerLogout.php'; // O la ruta de tu controlador de logout
        exit;
    // Módulos para administrador
    // ======= Módulo de información
    case 'admin/informacion':
        if ($tipo === 'administrador') {
            require_once $base . 'usadministrador/informacion/informacion.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
        break;
    //====== Módulo de sucursales
    case 'admin/sucursales':
        if ($tipo === 'administrador') {
            require_once $base . 'usadministrador/sucursales/sucursales.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
        break;

    case 'admin/sucursales/crear':
        if ($tipo === 'administrador') {
            // Procesar el formulario si es POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once $base_c . 'us_administrador/sucursales/crearSucursal.php';
                // Puedes redirigir o mostrar un mensaje después de procesar
                exit;
            }
            // Mostrar la vista si es GET
            require_once $base . 'usadministrador/sucursales/crear.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
    break;

    case 'admin/sucursales/editar':
    if ($tipo === 'administrador') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once $base_c . 'us_administrador/sucursales/editarSucursal.php';
            exit;
        }
        // Obtener datos de la sucursal para mostrar en el formulario
        $id = $_GET['id'] ?? null;
        if ($id) {
            require_once __DIR__ . '/../app/models/us_administrador/sucursales/modelSucursal.php';
            $sucursal = Sucursal::obtenerPorId($id); // Debes tener este método en tu modelo
            if ($sucursal) {
                require $base . 'usadministrador/sucursales/editar.php';
            } else {
                echo "Sucursal no encontrada.";
            }
        } else {
            echo "ID de sucursal no especificado.";
        }
        exit;
    } else {
        http_response_code(403);
        echo "<h1>403 - Acceso denegado</h1>";
    }
    break;

    case 'admin/sucursales/eliminar':
    if ($tipo === 'administrador' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once $base_c . 'us_administrador/sucursales/eliminarSucursal.php';
        exit;
    } else {
        http_response_code(403);
        echo "<h1>403 - Acceso denegado</h1>";
    }
    break;
    
// ======= Módulo de usuarios
    case 'admin/usuarios':
        if ($tipo === 'administrador') {
            require_once $base . 'usadministrador/usuarios/usuarios.php';
        } 
        else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
        break;

    case 'admin/usuarios/btn_crear_us':
        if ($tipo === 'administrador') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        require_once $base_c . 'us_administrador/usuarios/crearUsuario.php';
                        exit;
                    }
                    // Mostrar la vista si es GET
                require_once $base . 'usadministrador/usuarios/btn_crear_us.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
        break;

    case 'admin/usuarios/btn_edit_us':
        if ($tipo === 'administrador') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once $base_c . 'us_administrador/usuarios/editarUsuario.php';
                exit;
        }
        // Obtener datos del usuario para mostrar en el formulario
        $id = $_GET['id'] ?? null;
        if ($id) {
            require_once __DIR__ . '/../app/models/us_administrador/usuarios/modelUsuarios.php';
            $usuario = Usuarios::obtenerUsuarioPorId($id); // Debes tener este método en tu modelo
            if ($usuario) {
                require $base . 'usadministrador/usuarios/btn_editUsuario.php';
            } else {
                echo "Usuario no encontrada.";
            }
        } else {
            echo "ID de Usuario no especificado.";
        }
        exit;
    } else {
        http_response_code(403);
        echo "<h1>403 - Acceso denegado</h1>";
    }
    break;

    case 'admin/usuarios/eliminar':
    if ($tipo === 'administrador' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once $base_c . 'us_administrador/usuarios/eliminarUsuario.php';
        exit;
    } else {
        http_response_code(403);
        echo "<h1>403 - Acceso denegado</h1>";
    }
    break;

    case 'admin/usuarios/MasInformacion':
    if ($tipo === 'administrador') {
        $id = $_GET['id'] ?? null;
        if ($id) {
            require_once __DIR__ . '/../app/models/us_administrador/usuarios/modelUsuarios.php';
            $usuario = Usuarios::obtenerUsuarioPorId($id);
            if ($usuario) {
                require $base . 'usadministrador/usuarios/btn_MInf.php';
            } else {
                echo "Usuario no encontrado.";
            }
        } else {
            echo "ID de Usuario no especificado.";
        }
        exit;
    } else {
        http_response_code(403);
        echo "<h1>403 - Acceso denegado</h1>";
    }
    break;
// ======= Módulo de ventas
    case 'admin/reporte_ventas':
        if ($tipo === 'administrador') {
            require_once $base . 'usadministrador/reporte_ventas/reporte_ventas.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
        break;
    
    case 'admin/reporte_ventas/HistorialVentas':
    if ($tipo === 'administrador') {
        require_once $base . 'usadministrador/reporte_ventas/btn_historialVe.php';
    } else {
        http_response_code(403);
        echo "<h1>403 - Acceso denegado</h1>";
    }
    break;
// ======= Módulo de inventario
    case 'admin/inventario':
        if ($tipo === 'administrador') {
            require_once $base . 'usadministrador/inventario/inventario.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
        break;
        // Ruta para movimientos inventario
    case 'admin/movimientosInventario':
        if ($tipo === 'administrador'){
            require_once $base . 'usadministrador/inventario/btn_MInventario.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
        break;

        // Ruta para el CRUD de productos
    case 'admin/inventario/Productos':
        if ($tipo === 'administrador') {
            require_once $base . 'usadministrador/inventario/btn_VProductos.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
        break;
    case 'admin/inventario/AnadirProducto':
        if ($tipo === 'administrador') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        require_once $base_c . 'us_administrador/inventario/crearProducto.php';
                        exit;
                    }
                require_once $base . 'usadministrador/inventario/btn_AProducto.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
        break;

    case 'admin/inventario/EditarProducto':
        if ($tipo === 'administrador') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once $base_c . 'us_administrador/inventario/editarProducto.php';
                exit;
        }
        // Obtener datos del producto para mostrar en el formulario
        $id = $_GET['id'] ?? null;
        if ($id) {
            require_once __DIR__ . '/../app/models/us_administrador/inventario/modelInventario.php';
            $producto = Producto::obtenerProductoPorId($id); // Debes tener este método en tu modelo
            if ($producto) {
                require $base . 'usadministrador/inventario/btn_EProducto.php';
            } else {
                echo "Producto no encontrada.";
            }
        } else {
            echo "ID de Producto no especificado.";
        }
        exit;
    } else {
        http_response_code(403);
        echo "<h1>403 - Acceso denegado</h1>";
    }
    break;

    case 'admin/inventario/EliminarProducto':
    if ($tipo === 'administrador' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once $base_c . 'us_administrador/inventario/eliminarProducto.php';
        exit;
    } else {
        http_response_code(403);
        echo "<h1>403 - Acceso denegado</h1>";
    }
    break;

// ======= Módulo de pedidos
    case 'admin/pedidos':
        if ($tipo === 'administrador') {
            require_once $base . 'usadministrador/pedidos/pedidos.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
        break;
    
    case 'admin/pedidos/HistorialPedidos':
        if ($tipo === 'administrador') {
            require_once $base . 'usadministrador/pedidos/btn_HPedidos.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
        break;
    
// //////////////////////////////////////////////////////////////////////////////
// Módulos para usuario estándar
// //////////////////////////////////////////////////////////////////////////////
        // ======= Módulo de información
    case 'usuario/perfil':
        if ($tipo === 'estandar') {
            require_once $base . 'usestandar/informacionUE/informacionUE.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
        break;

        // ======= Módulo de ventas
    case 'usuario/ventas':
        if ($tipo === 'estandar') {
            require_once $base . 'usestandar/registrarVentaUE/registrarVentaUE.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
        break;

    case 'usuario/registrarVenta':
        if ($tipo === 'estandar') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        require_once $base_c . 'us_estandar/registrarVentaUE/registrarVentaUE.php';
                        exit;
                    }
                require_once $base . 'usestandar/registrarVentaUE/registrarVentaUE.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
        break;
    
    case 'usuario/ventas/ventasRegistradas':
        if ($tipo === 'estandar') {
            require_once $base . 'usestandar/registrarVentaUE/btn_ventasRegistradasUE.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
        break;

        // Modulo de inventario
    case 'usuario/inventario':
        if ($tipo === 'estandar') {
            require_once $base . 'usestandar/inventarioUE/inventarioUE.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
    break;

    case 'usuario/inventario/actualizarInventario':
        if ($tipo === 'estandar') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once $base_c . 'us_estandar/inventarioUE/actualizarInventarioUE.php';
                exit;
            }
            require_once $base . 'usestandar/inventarioUE/btn_actualizarInventarioUE.php';
    } else {
        http_response_code(403);
        echo "<h1>403 - Acceso denegado</h1>";
    }
    break;

    // Módulo de pedidos
    case 'usuario/pedidos':
        if ($tipo === 'estandar') {
            require_once $base . 'usestandar/pedidosUE/pedidosUE.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
    break;

    case 'usuario/pedidos/registrarPedido':
        if ($tipo === 'estandar') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once $base_c . 'us_estandar/pedidosUE/registrarPedidoUE.php';
                exit;
            }
            require_once $base . 'usestandar/pedidosUE/btn_registrarPedidoUE.php';
        } else {
            http_response_code(403);
            echo "<h1>403 - Acceso denegado</h1>";
        }
    break;
    
    // //////////////////////////////////////////////////////////////////////////////
    // Módulos para usuario inventario
    // //////////////////////////////////////////////////////////////////////////////
    
    case 'inv/informacion':
    if ($tipo === 'inventario') {
        require_once $base . 'usinventario/informacionUI/informacionUI.php';
    } else {
        http_response_code(403);
        echo "<h1>403 - Acceso denegado</h1>";
    }
    break;

    case 'inv/inventario':
    if ($tipo === 'inventario') {
        require_once $base . 'usinventario/inventarioUI/asigInventarioUI.php';
    } else {
        http_response_code(403);
        echo "<h1>403 - Acceso denegado</h1>";
    }
    break;

    case 'inv/inventario/asigInventario':
    if ($tipo === 'inventario') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once $base_c . 'us_inventario/inventarioUI/con_asigInventarioUI.php';
            exit;
        }
        // Mostrar la vista si es GET
        require_once $base . 'usinventario/inventarioUI/asigInventarioUI.php';
    } else {
        http_response_code(403);
        echo "<h1>403 - Acceso denegado</h1>";
    }
    break;

    case 'inv/inventario/historialAsignaciones':
    if ($tipo === 'inventario') {
            require_once $base . 'usinventario/inventarioUI/historialAsigUI.php';
    } else {
        http_response_code(403);
        echo "<h1>403 - Acceso denegado</h1>";
    }
    break;


    default:
        http_response_code(404);
        echo "<h1>404 - Página no encontrada</h1>";
    break;
    
}
    