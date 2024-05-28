<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut - Acceso</title>
    <link href="img/icon-p.png" rel="icon">
    <link rel="stylesheet" href="css/iniciose.css">
    <script>
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
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
    </script>
</head>
<body>
    <main id="hero">
        <header>
            <div class="logo">
                <h1 class="logo"><a href="inter-inicio.php"><img src="img/icono.png" alt="icono" style="width: 60px;"></a></h1>
            </div>
        </header>
        <div class="inicio">
            <h2>Ingresa con tu cuenta</h2>
            <img src="img/icon-in.png" alt="icon" style="width: 60px; margin-bottom: 20px;">
            <form method="post" action="procesar_login.php" onsubmit="return validarFormulario()">
                <label for="correo">Correo electrónico</label><br>
                <input type="email" name="correo" id="correo"  autofocus><br>
                <label for="contrasena">Contraseña</label><br>
                <input type="password" name="contrasena" id="contrasena" ><br>
                <button type="submit">Ingresar</button>
            </form>
        </div>
        <video autoplay muted loop>
            <source src="videos/ini-inter.mp4" type="video/mp4">
        </video>
        <div class="capa"></div>
    </main>
    <script src="js/validar_iniciosesion.js"></script>
    <script>
    // Evitar que el usuario navegue hacia atrás
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    window.onpopstate = function() {
        window.history.go(1);
    };
</script>

</body>
</html>
