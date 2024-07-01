<?php
session_start();

// Verificar si la sesión 'Id_Cargo' está definida y es válida
if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../inicio sesion/iniciosesion.php");
    exit();
}

// Verificar si todas las variables de sesión requeridas están definidas
if (!isset($_SESSION['nombre_usuario']) || 
    !isset($_SESSION['apellido_usuario']) || 
    !isset($_SESSION['segu_usuario']) || 
    !isset($_SESSION['seg_apell_usuario']) ||
    !isset($_SESSION['num_doc']) ||
    !isset($_SESSION['Id_Cargo']) ||
    !isset($_SESSION['Correo'])) {
    // Redirigir a la página de inicio de sesión si alguna variable no está definida
    header("Location: ../inicio sesion/iniciosesion.php");
    exit();
}

// Determinar la página de redireccionamiento basada en el rol del usuario
$pagina_principal = ($_SESSION['Id_Cargo'] == 1) ? '../Admin/admin.php' : '../Admin/empleado.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="../Assets/img/icono.png" rel="icon">
    <link rel="stylesheet" href="../Assets/css/perfil.css">
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color:#f0f0f0; /* Color de fondo naranja */
            padding: 10px 0;
        }

        .logo {
            text-align: center;
        }

        .logo img {
            width: 70px;
        }

        #perfil {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .perfil-info {
            margin-bottom: 20px;
        }

        .perfil-info h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .perfil-info p {
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
        }

        .acciones {
            text-align: center;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff9800; /* Color de fondo naranja */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #f57c00; /* Color de fondo naranja oscuro al pasar el ratón */
        }
    </style>
</head>
<body>
<header>
    <div class="logo">
        <h1>
            <?php
            if (isset($_SESSION['Id_Cargo'])) {
                if ($_SESSION['Id_Cargo'] == 1) {
                    // Si es administrador, regresar a la página de administrador
                    echo '<a href="../Admin/admin.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a>';
                } elseif ($_SESSION['Id_Cargo'] == 2) {
                    // Si es empleado, regresar a la página de empleado
                    echo '<a href="../Admin/empleado.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a>';
                }
            } else {
                // Si no hay sesión, redirigir a la página de inicio de sesión
                echo '<a href="../inicio sesion/iniciosesion.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a>';
            }
            ?>
        </h1>
    </div>
</header>
<main id="perfil">
    <div class="perfil-info">
        <h2>Perfil de Usuario</h2>
        <p><strong>Nombre:</strong> <?php echo $_SESSION['nombre_usuario'] . ' ' . $_SESSION['segu_usuario'] . ' ' . $_SESSION['apellido_usuario'] . ' ' . $_SESSION['seg_apell_usuario']; ?></p>
        <p><strong>Número de Documento:</strong> <?php echo $_SESSION['num_doc']; ?></p>
        <p><strong>Cargo:</strong> <?php echo $_SESSION['Id_Cargo']; ?></p>
        <p><strong>Correo:</strong> <?php echo $_SESSION['Correo']; ?></p>
        <!-- Puedes mostrar más detalles del usuario si es necesario -->
    </div>
    <div class="acciones">
        <a href="<?php echo $pagina_principal; ?>" class="btn">Volver a la página principal</a>
    </div>
</main>
</body>
</html>
