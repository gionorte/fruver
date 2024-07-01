<?php
session_start();
if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: iniciosesion.php");
    exit();
}
$rol = $_SESSION['Id_Cargo'];

include ('../includes/conexion.php');

$sql = "SELECT Id_Cargo FROM persona WHERE Num_Doc = '$rol'";
 $result = $conn->query($sql);

 if ($result->num_rows == true){
    $fila = $result -> fetch_assoc();
    if ($fila ['Id_Cargo'] !=1){
        echo 'No tienes permiso para acceder a esta vista ';
        header("Location: iniciosesion.php");
        exit();
    } 
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut</title>
    <link href="../Assets/img/icono.png" rel="icon">
    <link rel="stylesheet" href="../Assets/css/admin_e.css">
</head>
<body>
    <main id="hero">
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
                echo '<a href="../inicio_sesion/iniciosesion.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a>';
            }
            ?>
        </h1>
    </div>
            <div class="logo">
            <a href="ver_perfil.php"><img src="../Assets/img/usuario.png" alt="icono" style="width: 40px;"></a>

        <a href="../inicio_sesion/iniciosesion.php" id="cerrar-sesion">
            <img src="../Assets/img/cerrar-sesion.png" alt="icono" style="width: 30px;">
        </a>
    </div>

        </header>

        <div class="background-img"></div> <!-- La imagen de fondo se aplicará como un div de fondo absoluto -->
        
        <div class="sidebar">
            <img src="../Assets/img/icon-in.png" alt="icon">
            <h2><?php echo $_SESSION['nombre_usuario'] . ' ' . $_SESSION['segu_usuario']. ' ' . $_SESSION['apellido_usuario']. ' ' . $_SESSION['seg_apell_usuario']; ?></h2> 
            <button class="btn" onclick="window.location.href='registrar.php'">Registrar Empleado</button>
            <button class="btn" onclick="window.location.href='../Productos/regis-producto.php'">Registrar Producto</button>
            <button class="btn" onclick="window.location.href=''">Ver Orden de Compra</button>
            <button class="btn" onclick="window.location.href='../Productos/lista-produc.php'">Lista de Productos</button>
            <button class="btn" onclick="window.location.href='lista-empleados.php'">Lista de Empleados</button>
            <button class="btn" onclick="window.location.href='tareas_empleado.php'">consultar Tarea</button>
        </div>
    </main>
    <script>
        // Obtener el elemento del enlace para cerrar sesión
        const linkCerrarSesion = document.getElementById('cerrar-sesion');

        // Función para mostrar el mensaje de confirmación
        function confirmarCerrarSesion(event) {
            event.preventDefault(); // Evitar que el enlace ejecute su acción por defecto

            // Mostrar mensaje de confirmación
            const confirmacion = confirm("¿Seguro que quieres cerrar sesión?");
            
            // Si el usuario confirma, redirigir a la página de cerrar sesión
            if (confirmacion) {
                window.location.href = "../inicio_sesion/cerrar_sesion.php";
            }
        }

        // Agregar el evento click al enlace para cerrar sesión
        linkCerrarSesion.addEventListener('click', confirmarCerrarSesion);
    </script>

</body>
</html>


