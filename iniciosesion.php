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
        }
    </script>
    <script>
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
    </script>
</head>
<body>
<header>
        <div class="logo">
            <h1 class="logo"><a href="index.php"><img src="img/icono.png" alt="icon" style="width: 60px;"></a></h1>
        </div>
    </header>
    <h2>Ingresa con tu cuenta</h2>
    <form method="post" action="procesar_login.php" onsubmit="return validarFormulario()">
        Correo electrónico: <input type="text" name="correo" id="correo"><br>
        Contraseña: <input type="password" name="contrasena" id="contrasena"><br>
        <input type="submit" value="Iniciar sesión">
    
        <a href="registrar.php">Registrate</a>
    </form>
</body>
</html>
