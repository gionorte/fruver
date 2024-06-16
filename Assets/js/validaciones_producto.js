document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("form").addEventListener("submit", function(event) {
        if (!validarFormulario()) {
            event.preventDefault(); // Prevenir el envío del formulario si no es válido
        }
    });

    function validarFormulario() {
        var nomProduct = document.getElementById('nom_product').value;
        var cantidad = document.getElementById('cantidad').value;
        var fechaVenc = document.getElementById('fecha_venc').value;
        var descripcion = document.getElementById('descripcion').value;
        var idEstado = document.getElementById('id_estado').value;
        var precio = document.getElementById('precio').value;
        var imagen = document.getElementById('imagen').value;

        // Validar que los campos no estén vacíos
        if (nomProduct === "") {
            alert("El nombre del producto es obligatorio");
            return false;
        }

        // Validar que la cantidad sea mayor a 0
        if (cantidad <= 0) {
            alert("La cantidad debe ser mayor a 0");
            return false;
        }

        // Validar que la fecha de vencimiento sea futura
        var fechaActual = new Date().toISOString().split('T')[0]; // Fecha actual en formato yyyy-mm-dd
        if (fechaVenc <= fechaActual) {
            alert("La fecha de vencimiento debe ser una fecha futura");
            return false;
        }

        // Validar que la descripción no esté vacía
        if (descripcion === "") {
            alert("La descripción es obligatoria");
            return false;
        }

        // Validar que se haya seleccionado un estado
        if (idEstado === "") {
            alert("El estado es obligatorio");
            return false;
        }

        // Validar que el precio sea mayor a 0
        if (precio <= 0) {
            alert("El precio debe ser mayor a 0");
            return false;
        }

        // Validar que se haya seleccionado una imagen y que sea un archivo de imagen válido
        if (imagen === "") {
            alert("La imagen del producto es obligatoria");
            return false;
        }

        // Si todas las validaciones pasan, mostrar mensaje de éxito
        mostrarMensajeExito();
        return true;
    }

    function mostrarMensajeExito() {
        var mensajeExito = document.createElement('div');
        mensajeExito.textContent = "Registro exitoso";
        mensajeExito.classList.add('mensaje-exito');
        document.body.appendChild(mensajeExito);
        setTimeout(function() {
            mensajeExito.style.display = 'none';
        }, 3000); // Ocultar el mensaje después de 3 segundos
    }
});
