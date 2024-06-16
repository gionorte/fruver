document.getElementById('inventoryForm').addEventListener('submit', function(event) {
    let isValid = true;

    // Validate ID Empleado
    const idEmpleado = document.getElementById('id_empleado');
    const errorEmpleado = document.getElementById('errorEmpleado');
    if (idEmpleado.value === '') {
        errorEmpleado.textContent = 'Seleccione un ID de empleado.';
        isValid = false;
    } else {
        errorEmpleado.textContent = '';
    }

    // Validate Nombre del Producto
    const nomProduct = document.getElementById('nom_product');
    const errorProducto = document.getElementById('errorProducto');
    if (nomProduct.value.trim() === '') {
        errorProducto.textContent = 'Ingrese el nombre del producto.';
        isValid = false;
    } else {
        errorProducto.textContent = '';
    }

    // Validate Lote
    const lote = document.getElementById('lote');
    const errorLote = document.getElementById('errorLote');
    if (lote.value === '') {
        errorLote.textContent = 'Seleccione un lote.';
        isValid = false;
    } else {
        errorLote.textContent = '';
    }

    // Validate ID Producto
    const idProducto = document.getElementById('id_producto');
    const errorIdProducto = document.getElementById('errorIdProducto');
    if (idProducto.value === '') {
        errorIdProducto.textContent = 'Seleccione un ID de producto.';
        isValid = false;
    } else {
        errorIdProducto.textContent = '';
    }

    // Validate ID Venta
    const idVenta = document.getElementById('id_venta');
    const errorIdVenta = document.getElementById('errorIdVenta');
    if (idVenta.value === '') {
        errorIdVenta.textContent = 'Seleccione un ID de venta.';
        isValid = false;
    } else {
        errorIdVenta.textContent = '';
    }

    if (!isValid) {
        event.preventDefault();
    }
});
