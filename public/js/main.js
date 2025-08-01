// Sucursales
function A_sucursal() {
    window.location.href = '/admin/sucursales/crear';
}

// Usuarios
function C_usuarios() {
    window.location.href = '/admin/usuarios/btn_crear_us';
}

// Reporte de Ventas
function H_ventas() {
    window.location.href = '/admin/reporte_ventas/HistorialVentas';
}

// Inventario - Ver productos
function btn_VProductos() {
    window.location.href = '/admin/inventario/Productos';
}

// Inventario - Añadir productos
function btn_AProducto() {
    window.location.href = '/admin/inventario/AnadirProducto';
}

function btn_historialAsigUI() {
    window.location.href = '/inv/inventario/historialAsignaciones';
}
// Pedidos - Historial
function btn_HPedidos() {
    window.location.href = '/admin/pedidos/HistorialPedidos';
}

// Usuario Estándar - Ventas registradas
function btn_ventasRegistradasUE() {
    window.location.href = '/usuario/ventas/ventasRegistradas';
}

// Usuario Estándar - Actualizar inventario
function btn_actualizarInventarioUE() {
    window.location.href = '/usuario/actualizar_inventario';
}

// Usuario Estándar - Lista de pedidos
function btn_listaPedidosUE() {
    window.location.href = '/usuario/lista_pedidos';
}
//  Usuario Administrador - Movimientos Inventario
function btn_MInventario(){
    window.location.href = '/admin/movimientosInventario'
}

document.addEventListener('DOMContentLoaded', function() {
    const imgMenu = document.querySelector('.img-menu');
    const miniMenu = document.querySelector('.mini-content');
    if (imgMenu && miniMenu) {
        imgMenu.addEventListener('click', function() {
            miniMenu.classList.toggle('menu-visible');
        });
    }
});