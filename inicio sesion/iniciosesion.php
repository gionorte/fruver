<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut - Acceso</title>
    <link href="../Assets/img/icon-p.png" rel="icon">
    <link rel="stylesheet" href="../Assets/css/iniciose.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <main id="hero">
        <header>
            <div class="logo">
                <h1 class="logo"><a href="../inter-inicio.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 60px;"></a></h1>
            </div>
        </header>
        <div class="inicio">
            <h2>Ingresa con tu cuenta</h2>
            <img src="../Assets/img/icon-in.png" alt="icon" style="width: 60px; margin-bottom: 20px;">
            <form id="miFormulario" method="post" action="procesar_login.php" onsubmit="return validarFormulario(event)">
                <label for="correo">Correo electrónico</label><br>
                <input type="email" name="correo" id="correo" autofocus><br>
                <label for="contrasena">Contraseña</label><br>
                <input type="password" name="contrasena" id="contrasena"><br>
                <i class="fa fa-eye eye-icon" id="eye-icon"></i>
                <a href="../recuperar contraseña/recuperar_con_corr.php">Olvidaste la Contraseña</a>
                <br>
                <button type="submit">Ingresar</button>
            </form>
            <?php 
    if(isset($_GET['message'])){
     
    ?>
      <div class="alert alert-primary" role="alert">
        <?php 
        switch ($_GET['message']) {
          case 'ok':
            echo 'Por favor, revisa tu correo';
            break;
          case 'success_password':
            echo 'Inicia sesión con tu nueva contraseña';
            break;
            
          default:
            echo 'Algo salió mal, intenta de nuevo';
            break;
        }
        ?>
      </div>
    <?php
    }
    ?>
            <?php
            if (!empty($error)) {
                echo "<p style='color:red;'>$error</p>";
            }
            ?>
        </div>
        <video autoplay muted loop>
            <source src="../Assets/videos/ini-inter.mp4" type="video/mp4">
        </video>
        <div class="capa"></div>
    </main>
    <script src="../Assets/js/validar_iniciosesion.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const eyeIcon = document.getElementById('eye-icon');
            const passwordInput = document.getElementById('contrasena');

            eyeIcon.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                eyeIcon.classList.toggle('fa-eye-slash'); // Cambia el ícono a ojo tachado cuando la contraseña es visible
            });
        });
    </script>
</body>

</html>