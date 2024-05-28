function validarFormulario() {
    var correo = document.getElementById('correo').value;
    var contrasena = document.getElementById('contrasena').value;

    // Comprobar si los campos están vacíos
    if (correo.trim() === '' || contrasena.trim() === '') {
        alert('Por favor, complete todos los campos.');
        return false; // Evitar el envío del formulario
    }

    // Validación básica del formato del correo electrónico
    var correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!correoRegex.test(correo)) {
        alert('Por favor, ingrese un correo electrónico válido.');
        return false;
    }

    // Validación de la contraseña (mínimo 8 caracteres)
    if (contrasena.length < 8) {
        alert('La contraseña debe tener al menos 8 caracteres.');
        return false;
    }

    // Validación de caracteres no deseados en la contraseña
    var contrasenaRegex = /^[A-Za-z0-9!@#$%^&*()_+=\-`~\[\]{}|\\:;"'<>,.?/]*$/;
    if (!contrasenaRegex.test(contrasena)) {
        alert('La contraseña contiene caracteres no permitidos.');
        return false;
    }

    return true; // Permitir el envío del formulario
}

// Evitar que el usuario navegue hacia atrás
window.addEventListener('popstate', function () {
    history.pushState(null, null, document.URL);
});

window.onload = function() {
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    window.onpopstate = function() {
        window.history.go(1);
    };
}