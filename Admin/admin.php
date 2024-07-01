<?php
include('../includes/conexion.php');

// Asegúrate de que no haya ninguna salida antes de session_start()
session_start();

if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../inicio_sesion/iniciosesion.php");
    exit();
}

$rol = $_SESSION['Id_Cargo'];

$sql = "SELECT Id_Cargo FROM persona WHERE Num_Doc = '$rol'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $fila = $result->fetch_assoc();
    if ($fila['Id_Cargo'] != 1) {
        echo 'No tienes permiso para acceder a esta vista ';
        header("Location: ../inicio_sesion/iniciosesion.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut</title>
    <link href="../Assets/img/icono.png" rel="icon">
    <link rel="stylesheet" href="../Assets/css/admin_e.css">
    <style>
        .notificaciones-container {
            position: absolute;
            top: 60px;
            right: 20px;
            width: 300px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: none;
            z-index: 10;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .notificacion {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .notificacion p {
            margin: 0;
        }
        .notificacion small {
            color: #888;
        }
        .notificacion:last-child {
            border-bottom: none;
        }
    </style>
</head>

<body>
    <main id="hero">
        <header>
            <div class="logo">
                <h1 class="logo"><a href="admin.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a></h1>
            </div>
            <div class="usuario-info">
                <a href="ver_perfil.php"><img src="../Assets/img/usuario.png" alt="icono" style="width: 40px;"></a>
                <a href="#" id="notificacion">
                    <img src="../Assets/img/notificacion.png" alt="icono notificación" style="width: 40px;">
                    <span id="icono-notificacion" class="badge" data-count="0"></span>
                </a>
                <a href="../inicio_sesion/cerrar_sesion.php" id="cerrar-sesion">
                    <img src="../Assets/img/cerrar-sesion.png" alt="icono cerrar sesión" style="width: 40px;">
                </a>
            </div>
        </header>

        <div class="background-img"></div>

        <div class="sidebar">
            <img src="../Assets/img/icon-in.png" alt="icon">
            <h2><?php echo $_SESSION['nombre_usuario'] . ' ' . $_SESSION['segu_usuario'] . ' ' . $_SESSION['apellido_usuario'] . ' ' . $_SESSION['seg_apell_usuario']; ?></h2>
            <button class="btn" onclick="window.location.href='registrar.php'">Registrar Empleado</button>
            <button class="btn" onclick="window.location.href='../Productos/regis-producto.php'">Registrar Producto</button>
            <button class="btn" onclick="window.location.href='../Inventario/Registrar_inventario.php'">Registrar Inventario</button>
            <button class="btn" onclick="window.location.href='lista_orden.php'">Ver Orden de Compra</button>
            <button class="btn" onclick="window.location.href='../Productos/lista-produc.php'">Lista de Productos</button>
            <button class="btn" onclick="window.location.href='lista-empleados.php'">Lista de Empleados</button>
            <button class="btn" onclick="window.location.href='../Inventario/lista_inventario.php'">Lista de Inventarios</button>
            <button class="btn" onclick="window.location.href='asignar_tarea.php'">Asignar Tarea</button>
            <button class="btn" onclick="window.location.href='../Carrito/tienda.php'">Ver tienda</button>
        </div>

        <div class="notificaciones-container" id="notificaciones-container"></div>
    </main>

    <script>
    const linkCerrarSesion = document.getElementById('cerrar-sesion');

    function confirmarCerrarSesion(event) {
        event.preventDefault();

        const confirmacion = confirm("¿Seguro que quieres cerrar sesión?");
        if (confirmacion) {
            window.location.href = "../inicio_sesion/cerrar_sesion.php";
        }
    }

    if (linkCerrarSesion) {
        linkCerrarSesion.addEventListener('click', confirmarCerrarSesion);
    }

</script>

</body>

</html>

