document.addEventListener('DOMContentLoaded', function() {
    // Mostrar notificación de registro exitoso si está presente
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success') && urlParams.get('success') === 'true') {
        const notificacion = document.getElementById('notificacion');
        notificacion.style.display = 'block';
        setTimeout(function() {
            notificacion.style.display = 'none';
        }, 5000); // Ocultar después de 5 segundos
    }

    // Evitar que el usuario navegue hacia atrás
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    window.onpopstate = function() {
        window.history.go(1);
    };

    // Mostrar/ocultar contraseña
    const eyeIcon = document.getElementById('eye-icon');
    const passwordInput = document.getElementById('contrasena');
    eyeIcon.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.add('fa-eye-slash');
            eyeIcon.classList.remove('fa-eye');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.add('fa-eye');
            eyeIcon.classList.remove('fa-eye-slash');
        }
    });
});
