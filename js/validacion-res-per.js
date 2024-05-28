document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("form").addEventListener("submit", function(event) {
        if (!validarFormulario()) {
            event.preventDefault(); // Prevenir el envío del formulario si no es válido
        }
    });

    document.getElementById('eye-icon').addEventListener('click', togglePasswordVisibility);

    function validarFormulario() {
        var numDoc = document.getElementById('num_doc').value;
        var primNombre = document.getElementById('prim_nombre').value;
        var primApellido = document.getElementById('prim_apellido').value;
        var telefono = document.getElementById('telefono').value;
        var correo = document.getElementById('correo').value;
        var contrasena = document.getElementById('contrasena').value;

        // Validar que los campos no estén vacíos
        if (numDoc === "" || primNombre === "" || primApellido === "" || telefono === "" || correo === "" || contrasena === "") {
            alert("Todos los campos marcados con * son obligatorios");
            return false;
        }

        // Validar que el número de documento contenga solo números
        var numDocRegex = /^[0-9]+$/;
        if (!numDocRegex.test(numDoc)) {
            alert("El número de documento debe contener solo números");
            return false;
        }

        // Validar que el correo electrónico tenga el formato correcto
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(correo)) {
            alert("Por favor, ingresa un correo electrónico válido");
            return false;
        }

        // Validar que la contraseña cumpla con los requisitos
        var passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*]).{6,}$/;
        if (!passwordRegex.test(contrasena)) {
            alert("La contraseña debe tener al menos 6 caracteres, incluyendo una mayúscula y un carácter especial");
            return false;
        }

        return true;
    }

    function togglePasswordVisibility() {
        var passwordInput = document.getElementById('contrasena');
        var eyeIcon = document.getElementById('eye-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
});
