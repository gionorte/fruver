document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("form").addEventListener("submit", function(event) {
        validarFormulario().then(function(isValid) {
            if (!isValid) {
                event.preventDefault(); // Prevent form submission if not valid
            }
        });
    });

    document.getElementById('eye-icon').addEventListener('click', togglePasswordVisibility);

    function validarFormulario() {
        return new Promise(function(resolve) {
            var numDoc = document.getElementById('num_doc').value;
            var primNombre = document.getElementById('prim_nombre').value;
            var primApellido = document.getElementById('prim_apellido').value;
            var telefono = document.getElementById('telefono').value;
            var correo = document.getElementById('correo').value;
            var contrasena = document.getElementById('contrasena').value;

            // Validate fields are not empty
            if (numDoc === "" || primNombre === "" || primApellido === "" || telefono === "" || correo === "" || contrasena === "") {
                alert("Todos los campos marcados con * son obligatorios");
                resolve(false);
                return;
            }

            // Validate document number contains only numbers
            var numDocRegex = /^[0-9]+$/;
            if (!numDocRegex.test(numDoc)) {
                alert("El número de documento debe contener solo números");
                resolve(false);
                return;
            }

            // Validate email format
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(correo)) {
                alert("Por favor, ingresa un correo electrónico válido");
                resolve(false);
                return;
            }

            // Validate password requirements
            var passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*]).{6,}$/;
            if (!passwordRegex.test(contrasena)) {
                alert("La contraseña debe tener al menos 6 caracteres, incluyendo una mayúscula y un carácter especial");
                resolve(false);
                return;
            }

            // Perform AJAX request to validate uniqueness
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "procesar_regis.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.num_doc === 'exists') {
                        alert("El número de documento ya existe");
                        resolve(false);
                        return;
                    }

                    if (response.correo === 'exists') {
                        alert("El correo electrónico ya existe");
                        resolve(false);
                        return;
                    }

                    resolve(true);
                }
            };

            xhr.send("num_doc=" + encodeURIComponent(numDoc) + "&correo=" + encodeURIComponent(correo));
        });
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
