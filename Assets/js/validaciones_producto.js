function validarProducto() {
    let isValid = true;

    // Resetear mensajes de error
    document.querySelectorAll('.error-message').forEach(function (el) {
        el.textContent = '';
    });

    // Validar cada campo
    const nomProduct = document.getElementById('nom_product');
    const cantidad = document.getElementById('cantidad');
    const fechaVenc = document.getElementById('fecha_venc');
    const descripcion = document.getElementById('descripcion');
    const idEstado = document.getElementById('id_estado');
    const precio = document.getElementById('precio');
    const imagen = document.getElementById('imagen');

    if (nomProduct.value.trim() === '') {
        document.getElementById('nom_product_error').textContent = 'Ingrese el nombre del producto.';
        isValid = false;
    }

    if (cantidad.value.trim() === '') {
        document.getElementById('cantidad_error').textContent = 'Ingrese la cantidad del producto.';
        isValid = false;
    }

    if (fechaVenc.value.trim() === '') {
        document.getElementById('fecha_venc_error').textContent = 'Ingrese la fecha de vencimiento del producto.';
        isValid = false;
    }

    if (descripcion.value.trim() === '') {
        document.getElementById('descripcion_error').textContent = 'Ingrese la descripción del producto.';
        isValid = false;
    }

    if (idEstado.value === '') {
        document.getElementById('id_estado_error').textContent = 'Seleccione el estado del producto.';
        isValid = false;
    }

    if (precio.value.trim() === '') {
        document.getElementById('precio_error').textContent = 'Ingrese el precio del producto.';
        isValid = false;
    }

    if (imagen.files.length === 0) {
        document.getElementById('imagen_error').textContent = 'Seleccione una imagen del producto.';
        isValid = false;
    }

    return isValid;
}