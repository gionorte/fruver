<?php
session_start();
if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: iniciosesion.php");
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
    <link rel="stylesheet" href="css/admin-e.css">
</head>
<body>
    <main id="hero">
        <header>
            <div class="logo">
                <h1 class="logo"><a href="admin.php"><img src="img/icono.png" alt="icono" style="width: 70px;"></a></h1>
            </div>
            <div class="cerrar">
                <h1 class="logo"><a href="cerrar_sesion.php"><img src="img/cerrar-sesion.png" alt="icono" style="width: 30px;"></a></h1>
            </div>
        </header>

        <div class="background-img"></div> <!-- La imagen de fondo se aplicará como un div de fondo absoluto -->
        
        <div class="sidebar">
            <img src="img/icon-in.png" alt="icon">
            <h2>Erik Armando Pabon Tovar</h2>
            <button class="btn" onclick="window.location.href='registrar.php'">Registrar Empleado</button>
            <button class="btn" onclick="window.location.href='regis-producto.php'">Registrar Producto</button>
            <button class="btn" onclick="window.location.href='Registrar_inventario.php'">Registrar Inventario</button>
            <button class="btn" onclick="window.location.href=''">Ver Orden de Compra</button>
            <button class="btn" onclick="window.location.href='lista-produc.php'">Lista de Productos</button>
            <button class="btn" onclick="window.location.href='lista-empleados.php'">Lista de Empleados</button>
            <button class="btn" onclick="window.location.href='asignar_tarea.php'">Asignar Tarea</button>
        </div>
    </main>
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


