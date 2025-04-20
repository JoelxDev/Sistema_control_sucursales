// Sucursales
function A_sucursal(){
    window.location.href='../sucursales/anadir_sucursal.php';
    // El 'href' no es una funcion, es una propiedad de objeto 'location' y este de la funcion 'window'
}
// Usuarios
function C_usuarios() {
    window.location.href='../usuarios/btn_crear_us.php';
}

// Reporte de Ventas
function H_ventas() {
    window.location.href='../reporte_ventas/btn_historialVe.php';
}

// Inventarios, productos
function btn_VProductos() {
    window.location.href='../inventario/btn_VProductos.php';
}

// Inventario, añadir productos
function btn_AProducto(){
    window.location.href='../inventario/btn_AProducto.php';
} 
// Boton para ver el historial de pedidos 
function btn_HPedidos(){
    window.location.href='../pedidos/btn_HPedidos.php';
}

// Ventas registradas del usuario estandar

function btn_ventasRegistradasUE(){
    window.location.href='btn_ventasRegistradasUE.php';
}
// Actualizar Inventario del usuario estandar
function btn_actualizarInventarioUE(){
    window.location.href='btn_actualizarInventario.php';
}
// Lisat de pedidos del usuario estandar
function btn_listaPedidosUE(){
    window.location.href='btn_listaPedidosUE.php';
}