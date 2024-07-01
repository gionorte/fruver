<?php
session_start();
include '../includes/conexion.php';

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
    
// Variables para mostrar los datos actuales
$nombre_usuario = $_SESSION['nombre_usuario'];
$segundo_nombre = $_SESSION['segu_usuario'];
$apellido_usuario = $_SESSION['apellido_usuario'];
$segundo_apellido = $_SESSION['seg_apell_usuario'];
$num_doc = $_SESSION['num_doc'];
$correo = $_SESSION['Correo'];
$telefono = ($_SESSION['numero']) ;

// Inicialización de variables para manejar éxito y error
$exito = false;
$error = '';

// Verificar si se ha enviado el formulario de modificación
if (isset($_POST['modificar_perfil'])) {
    // Recoger los datos del formulario (incluyendo teléfono)
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
        // Actualizar la base de datos
        $query = "UPDATE persona SET 
                    Prim_Nombre = ?, 
                    Seg_Nombre = ?, 
                    Prim_Apellido = ?, 
                    Seg_Apellido = ?, 
                    Correo = ?, 
                    Telefono = ? 
                  WHERE Num_Doc = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssss", 
            $nombre_usuario_nuevo, 
            $segundo_nombre_nuevo, 
            $apellido_usuario_nuevo, 
            $segundo_apellido_nuevo, 
            $correo_nuevo, 
            $telefono_nuevo, 
            $num_doc);

        if ($stmt->execute()) {
            // Actualización exitosa, actualizar la sesión
            $_SESSION['nombre_usuario'] = $nombre_usuario_nuevo;
            $_SESSION['segu_usuario'] = $segundo_nombre_nuevo;
            $_SESSION['apellido_usuario'] = $apellido_usuario_nuevo;
            $_SESSION['seg_apell_usuario'] = $segundo_apellido_nuevo;
            $_SESSION['Correo'] = $correo_nuevo;
            $_SESSION['Telefono'] = $telefono_nuevo;

            // Mostrar mensaje de éxito
            $exito = true;
        } else {
            $error = 'Error al actualizar el perfil.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Perfil</title>
    <link href="../Assets/img/icono.png" rel="icon">
    <link rel="stylesheet" href="../Assets/css/perfil.css">
    <style>
        /* Estilo general para el cuerpo y el fondo */
        body {
            background-color: #f5f5f5; /* Color de fondo gris claro */
            font-family: Arial, sans-serif; /* Fuente para el cuerpo */
            margin: 0;
            padding: 0;
        }

        /* Estilo para el encabezado */
        header {
            background-color: #fff; /* Fondo oscuro para el encabezado */
            color: #fff; /* Texto blanco */
            padding: 10px;
        }

        /* Estilo para el logotipo en el encabezado */
        .logo {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Estilo para el formulario de modificación de perfil */
        #perfil {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff; /* Fondo blanco para el formulario */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra ligera */
        }

        /* Estilo para los títulos dentro del formulario */
        .perfil-info h2 {
            color: orange; /* Color naranja para los títulos */
            margin-bottom: 20px;
        }

        /* Estilo para etiquetas de formulario */
        label {
            font-weight: bold;
            color: #555; /* Color de texto gris oscuro para las etiquetas */
        }

        /* Estilo para los campos de entrada */
        input[type=text],
        input[type=email] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
            border: 1px solid #ccc; /* Borde gris claro */
            border-radius: 4px;
            box-sizing: border-box; /* Caja de tamaño que incluye el relleno */
        }

        /* Estilo para los botones en el formulario */
        .btn {
            background-color: orange; /* Fondo naranja para los botones */
            color: #fff; /* Texto blanco */
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }

        .btn:hover {
            background-color: #ff9900; /* Cambio de color al pasar el ratón */
        }

        /* Estilo para los mensajes de error */
        .error-msg {
            color: red; /* Texto rojo para mensajes de error */
            margin-bottom: 10px;
        }

        /* Estilo para los mensajes de éxito */
        .exito-msg {
            color: green; /* Texto verde para mensajes de éxito */
            margin-bottom: 10px;
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
                    echo '<a href="perfil_cliente.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a>';
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
        <h2>Modificar Perfil</h2>
        <?php if ($exito): ?>
            <div class="exito-msg">
                <p>Perfil actualizado correctamente.</p>
            </div>
        <?php endif; ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="nombre_usuario">Nombre:</label><br>
            <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo htmlspecialchars($nombre_usuario); ?>" required><br><br>
            
            <label for="segundo_nombre">Segundo Nombre:</label><br>
            <input type="text" id="segundo_nombre" name="segundo_nombre" value="<?php echo htmlspecialchars($segundo_nombre); ?>"><br><br>

            <label for="apellido_usuario">Apellido:</label><br>
            <input type="text" id="apellido_usuario" name="apellido_usuario" value="<?php echo htmlspecialchars($apellido_usuario); ?>" required><br><br>

            <label for="segundo_apellido">Segundo Apellido:</label><br>
            <input type="text" id="segundo_apellido" name="segundo_apellido" value="<?php echo htmlspecialchars($segundo_apellido); ?>"><br><br>

            <label for="correo">Correo:</label><br>
            <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($correo); ?>" required><br><br>

            <label for="telefono">Teléfono:</label><br>
            <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>"><br><br>

            <a href="perfil_cliente.php" class="btn">Cancelar</a> <!-- Movido el botón de Cancelar aquí -->

            <button type="submit" name="modificar_perfil" class="btn">Guardar Cambios</button> <!-- Movido el botón de Guardar Cambios aquí -->

            <?php if ($error): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
    </div>
</main>
</body>
</html>
