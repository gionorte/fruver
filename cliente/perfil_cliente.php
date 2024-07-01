<?php
session_start();

// Verificar si la sesión está iniciada y el rol es cliente (Id_Cargo = 3)
if (!isset($_SESSION['Id_Cargo']) || $_SESSION['Id_Cargo'] != 3) {
    header("Location: iniciosesion.php");
    exit();
}

// Verificar si todas las variables de sesión requeridas están definidas
if (!isset($_SESSION['nombre_usuario']) || 
    !isset($_SESSION['apellido_usuario']) || 
    !isset($_SESSION['segu_usuario']) || 
    !isset($_SESSION['seg_apell_usuario']) ||
    !isset($_SESSION['num_doc']) ||
    !isset($_SESSION['Correo']) ||
    !isset($_SESSION['numero']) ||
    !isset($_SESSION['Contrasena'])) 


// Determinar la página de redireccionamiento basada en el rol del usuario
$pagina_principal = '../inicio_cliente.php'; // Página principal del cliente

// Variables para manejar la modificación de perfil
$error = '';
$exito = false;

// Verificar si se ha enviado el formulario de modificación de perfil
if (isset($_POST['modificar_perfil'])) {
    // Recoger los datos del formulario
    $nombre_usuario_nuevo = $_POST['nombre_usuario'];
    $segundo_nombre_nuevo = $_POST['segundo_nombre'];
    $apellido_usuario_nuevo = $_POST['apellido_usuario'];
    $segundo_apellido_nuevo = $_POST['segundo_apellido'];
    $correo_nuevo = $_POST['correo'];
    $telefono_nuevo = $_POST['telefono'];

    // Validación básica (puedes agregar más validaciones según tus necesidades)
    if (empty($nombre_usuario_nuevo) || empty($apellido_usuario_nuevo) || empty($correo_nuevo)) {
        $error = 'Todos los campos son obligatorios.';
    } else {
        // Aquí deberías realizar la actualización en la base de datos
        // En este ejemplo, solo actualizamos la sesión (simulación)
        $_SESSION['nombre_usuario'] = $nombre_usuario_nuevo;
        $_SESSION['segu_usuario'] = $segundo_nombre_nuevo;
        $_SESSION['apellido_usuario'] = $apellido_usuario_nuevo;
        $_SESSION['seg_apell_usuario'] = $segundo_apellido_nuevo;
        $_SESSION['Correo'] = $correo_nuevo;
        $_SESSION['Telefono'] = $telefono_nuevo;

        // Marcamos éxito para mostrar el mensaje
        $exito = true;
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Cliente</title>
    <link href="../Assets/img/icono.png" rel="icon">
    <link rel="stylesheet" href="../Assets/css/perfil.css">
    <style>
 /* Estilos generales */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

header {
    background-color:#fff;
    color: #fff;
    padding: 10px;
}

.logo {
    display: flex;
    justify-content: space-between;
    align-items: center;
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
    color: orange;
    margin-bottom: 10px;
}

.acciones {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn {
    background-color: orange;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    text-align: center;
}

.btn:hover {
    background-color: #ff9900;
}

.acciones form {
    display: inline-block;
}

.acciones form label {
    margin-right: 10px;
}

.acciones form input[type=password] {
    padding: 8px;
    margin-right: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.error-msg {
    color: red;
    margin-top: 5px;
}

.exito-msg {
    color: green;
    margin-top: 5px;
}
    #formularioEliminar {
        margin: 0 auto; /* Centra horizontalmente */
        max-width: 300px; /* Ancho máximo del formulario */
        background-color: #f9f9f9; /* Color de fondo */
        padding: 20px; /* Espaciado interior */
        border: 1px solid #ccc; /* Borde del formulario */
        border-radius: 5px; /* Borde redondeado */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra */
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
                    echo '<a href="../Admin/admin.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a>';
                } elseif ($_SESSION['Id_Cargo'] == 2) {
                    echo '<a href="../Admin/empleado.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a>';
                } elseif ($_SESSION['Id_Cargo'] == 3) {
                    echo '<a href="../inicio_cliente.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a>';
                }
            } else {
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
        <p><strong>Número:</strong> <?php echo $_SESSION['numero']; ?></p>
        <p><strong>Correo:</strong> <?php echo $_SESSION['Correo']; ?></p>
        <!-- Puedes mostrar más detalles del usuario si es necesario -->
    </div>
    <div class="acciones">
        <a href="../cliente/modificar_perfil.php" class="btn">Modificar Perfil</a>

        
        <!-- Mensaje de éxito -->
        <?php if ($exito): ?>
            <div class="exito-msg">
                <p>Perfil actualizado correctamente.</p>
            </div>
        <?php endif; ?>
        
        <!-- Enlace para eliminar cuenta -->
        <a href="#" onclick="mostrarFormularioEliminar(this); return false;" class="btn">Eliminar Cuenta</a>

        <div id="formularioEliminar" style="display: none; text-align: center; margin-top: 20px;">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return confirm('¿Estás seguro que deseas eliminar tu cuenta? Esta acción no se puede deshacer.');">
            <label for="contrasena">Ingresa tu contraseña para confirmar:</label><br>
            <input type="password" id="contrasena" name="contrasena" required><br><br>
            <button type="submit" name="confirmar_eliminar" class="btn">Eliminar Cuenta</button><br><br>
            <?php if ($error): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
        
        <!-- Botón para salir del formulario de eliminación -->
        <a href="#" onclick="reiniciarPagina(); return false;" class="btn">Salir</a>
    </div>
</main>

<script>
    function mostrarFormularioEliminar(botonEliminar) {
        var formularioEliminar = document.getElementById('formularioEliminar');
        
        formularioEliminar.style.display = 'block';
        botonEliminar.style.display = 'none'; // Oculta el botón 'Eliminar Cuenta'
    }
    
    function reiniciarPagina() {
        location.reload(); // Recarga la página
    }
</script>
</body>
</html>