<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut</title>
    <link href="img/icono.png" rel="icon">
    <link rel="stylesheet" href="css/iniciose.css">
    <script>
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
    </script>
</head>
<body>
    <div class="overlay"></div> <!-- Esta es la superposición semitransparente -->
    <header>
        <div class="logo">
            <h1 class="logo"><a href="index.html"><img src="img/icono.png" alt="icon" style="width: 60px;"></a></h1>
        </div>
    </header>
    <div class="login-wrap cover">
        <div class="container-login">
            <img src="img/iconus.png" alt="icon">
            <p class="text-center">
                <i class="zmdi zmdi-account-circle"></i>
            </p>
            <p class="text-center text-condensedLight">Ingresa con tu cuenta</p>
            <form action="" method="POST">
                <br>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" name="correo" type="text" id="correo">
                    <label class="mdl-textfield__label" for="correo">Correo</label>
                </div>
                <br>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input-" name="contrasena" type="password" id="pass">
                    <label class="mdl-textfield__label" for="pass">Contraseña</label>
                </div>
                <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                    <i class="fas fa-sign-in-alt"></i> INGRESAR
                </button>
            </form>
        </div>
    </div>
    <br>
    <br>
    <br>
</body>
</html>

