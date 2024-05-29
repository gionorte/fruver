<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut - Acceso</title>
    <link href="img/icon-p.png" rel="icon">
    <link rel="stylesheet" href="css/iniciose.css">
   
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
