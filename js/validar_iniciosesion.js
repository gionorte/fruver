async function validarFormulario(event) {
    event.preventDefault(); // Evitar el envío del formulario de forma predeterminada

    var correo = document.getElementById("correo").value;
    var contrasena = document.getElementById("contrasena").value;

    // Comprobar si los campos están vacíos
    if (correo.trim() === "" || contrasena.trim() === "") {
        alert("Por favor, complete todos los campos.");
        return false;
    }

    // Validación básica del formato del correo electrónico
    var correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!correoRegex.test(correo)) {
        alert("Por favor, ingrese un correo electrónico válido.");
        return false;
    }

    // Validación de la contraseña (mínimo 8 caracteres)
    if (contrasena.length < 8) {
        alert("La contraseña debe tener al menos 8 caracteres.");
        return false;
    }

    // Validación de caracteres permitidos en la contraseña
    var contrasenaRegex = /^[A-Za-z0-9!@#$%^&*()_+=\-`~\[\]{}|\\:;"'<>,.?\/]+$/;
    if (!contrasenaRegex.test(contrasena)) {
        alert("La contraseña contiene caracteres no permitidos.");
        return false;
    }

    // Si todas las validaciones se pasan, enviar el formulario
    document.getElementById("miFormulario").submit();
}


