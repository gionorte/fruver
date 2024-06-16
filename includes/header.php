<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Luxe & Simplicity</title>
    <link rel="stylesheet" href="<?php echo ('css/inter.in.css'); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>

    <header>
        <div class="header-container">
            <div class="logo">
                <h1 class="logo"><a href="inter-inicio.php"><img src="Assets/img/icono.png" alt="icon" style="width: 60px;"></a></h1>
            </div>
        </div>
        <div>
            <h2 class="eri">INZUFRUT</h2>
        </div>
        <i class="bi bi-list mobile-nav-toggle"></i> <!-- Icono de menú para dispositivos móviles -->
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="btn-get-started scrollto" href="../inter-inicio.php">Inicio</a></li>
                <li><a class="btn-get-started scrollto" href="../carrito/tienda.php">Productos</a></li>
                <li><a class="btn-get-started scrollto" href="../Contactanos/contactanos.php">Contactanos</a></li>
                <li><a class="btn-get-started scrollto" href="../cliente/registro_cliente.php">Registrate</a></li>
            </ul>

            <div class="profile-icon" onclick="toggleProfile()">
                <img src="Assets/img/usuario.png" alt="Profile Icon">
            </div>
        </nav>
        <button class="hamburger" onclick="toggleMenu()">☰</button>
    </header>

</body>

</html>