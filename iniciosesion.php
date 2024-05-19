<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut - Acceso</title>
    <link href="img/icono.png" rel="icon">
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
                <input type="email" name="correo" id="correo" required autofocus><br>
                <label for="contrasena">Contraseña</label><br>
                <input type="password" name="contrasena" id="contrasena" required><br>
                <button type="submit">Ingresar</button>
            </form>
        </div>
        <video autoplay muted loop>
            <source src="videos/inicio.mp4" type="video/mp4">
        </video>
        <div class="capa"></div>
    </main>
</body>
</html>
