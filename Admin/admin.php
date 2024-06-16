<?php
session_start();
if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../inicio sesion/iniciosesion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut</title>
    <link href="img/icono.png" rel="icon">
    <link rel="stylesheet" href="../Assets/css/admin_e.css">
</head>
<body>
    <main id="hero">
        <header>
            <div class="logo">
                <h1 class="logo"><a href="admin.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a></h1>
            </div>
            <div class="logo">
        <a href="../inicio sesion/iniciosesion.php" id="cerrar-sesion">
            <img src="../Assets/img/cerrar-sesion.png" alt="icono" style="width: 30px;">
        </a>
    </div>

        </header>

        <div class="background-img"></div> <!-- La imagen de fondo se aplicará como un div de fondo absoluto -->
        
        <div class="sidebar">
            <img src="../Assets/img/icon-in.png" alt="icon">
            <h2>Erik Armando Pabon Tovar</h2>
            <button class="btn" onclick="window.location.href='registrar.php'">Registrar Empleado</button>
            <button class="btn" onclick="window.location.href='../Productos/regis-producto.php'">Registrar Producto</button>
            <button class="btn" onclick="window.location.href='../Inventario/Registrar_inventario.php'">Registrar Inventario</button>
            <button class="btn" onclick="window.location.href='#'">Ver Orden de Compra</button>
            <button class="btn" onclick="window.location.href='../Productos/lista-produc.php'">Lista de Productos</button>
            <button class="btn" onclick="window.location.href='lista-empleados.php'">Lista de Empleados</button>
            <button class="btn" onclick="window.location.href='../Inventario/lista_inventario.php'">Lista de Inventarios</button>
            <button class="btn" onclick="window.location.href='asignar_tarea.php'">Asignar Tarea</button>
            <button class="btn" onclick="window.location.href='../carrito/tienda.php'">Ver tienda</button>
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
                window.location.href = "../inicio sesion/cerrar_sesion.php";
            }
        }

        // Agregar el evento click al enlace para cerrar sesión
        linkCerrarSesion.addEventListener('click', confirmarCerrarSesion);
    </script>
</body>
</html>


