function actualizarCantidad(idProducto, cantidad) {
    $.ajax({
        url: 'actualizar_cantidad_carrito.php',
        type: 'GET',
        data: { id: idProducto, cantidad: cantidad },
        success: function(response) {
            let data = JSON.parse(response);
            if (data.status === 'success') {
                location.reload();
            } else {
                alert(data.message);
            }
        }
    });
}

function eliminarDelCarrito(idProducto) {
    $.ajax({
        url: 'actualizar_cantidad_carrito.php',
        type: 'GET',
        data: { id: idProducto, cantidad: 0 },
        success: function(response) {
            location.reload();
        }
    });
}

function vaciarCarrito() {
    $.ajax({
        url: 'vaciar_carrito.php',
        type: 'POST',
        success: function(response) {
            location.reload();
        }
    });
}
