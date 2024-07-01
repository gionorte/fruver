<?php
session_start();
include 'includes/conexion.php';

if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: iniciosesion.php");
    exit();
}


$sql = "SELECT id_producto, nom_product, descripcion, estado, precio, imagen, cantidad FROM productos";
$result = $conn->query($sql);

// Obtener la cantidad de productos en el carrito
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
$cantidadProductosCarrito = count($carrito);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut</title>
    <link href="Assets/img/icono.png" rel="icon">
    <style>
        /* Estilos Generales */
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        /* Header Styles */
        header {
            background-color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1000;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo a {
            display: flex;
            align-items: center;
            text-decoration: none; /* Quitar subrayado del enlace */
            color: inherit; /* Heredar color del texto */
        }

        .logo img {
            width: 60px; /* Tamaño fijo del logo */
            height: auto;
            margin-right: 10px;
        }

        .header-container {
            display: flex;
            align-items: center;
        }

        .header-container h2 {
            margin: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar li {
            margin-right: 20px;
        }

        .btn-get-started {
            padding: 10px 20px;
            background-color: #ffa500;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-get-started:hover {
            background-color: #ff8c00;
        }

        .carrito-icono {
            position: relative;
            cursor: pointer;
            display: inline-block;
            margin-left: 20px;
        }

        .carrito-icono img {
            width: 40px;
            height: auto;
        }

        .carrito-cantidad {
            position: absolute;
            top: -10px;
            right: -10px;
            background: orange;
            color: white;
            border-radius: 50%;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Estilos para la sección de Productos */
        h1 {
            text-align: center;
            margin: 20px 0;
        }

        .productos {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
        }

        .producto {
            text-align: center;
            margin: 20px;
            padding: 20px;
            border: 8px solid #fa8f03;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgb(243, 139, 3);
            max-width: 250px; /* Ancho máximo del producto */
            height: 400px; /* Altura fija del producto */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .producto img {
            width: 100%; /* Hacer que todas las imágenes tengan el mismo ancho */
            height: auto;
            border-radius: 5px;
            max-height: 200px; /* Ajustar altura máxima si es necesario */
        }

        .producto h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #0a0a0a;
        }

        .producto p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
            color: #080808;
        }

        .producto strong {
            font-weight: bold;
            color: #141414;
        }

        .producto button {
            padding: 10px 20px;
            background-color: #ffa500;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .producto button:hover {
            background-color: #ff8c00;
        }

        /* Estilos para pantallas pequeñas (menos de 600px) */
        @media (max-width: 600px) {
            .header-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .carrito-icono {
                margin-left: 0;
                margin-top: 10px;
            }

            .productos {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function agregarAlCarrito(idProducto) {
            $.ajax({
                url: 'cliente/agregar_carrito.php',
                type: 'GET',
                data: {
                    id: idProducto
                },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.status === 'success') {
                        $('.carrito-cantidad').text(data.cantidad);
                    } else if (data.status === 'error') {
                        alert(data.message);
                    }
                }
            });
        }

        function eliminarDelCarrito(idProducto) {
            $.ajax({
                url: 'cliente/eliminar_del_carrito.php',
                type: 'GET',
                data: {
                    id: idProducto
                },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.status === 'success') {
                        actualizarCantidadCarrito();
                        location.reload(); // Recargar la página para reflejar cambios
                    } else if (data.status === 'error') {
                        alert(data.message);
                    }
                }
            });
        }

        function vaciarCarrito() {
            $.ajax({
                url: 'cliente/vaciar_carrito.php',
                type: 'GET',
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.status === 'success') {
                        actualizarCantidadCarrito();
                        location.reload(); // Recargar la página para reflejar cambios
                    } else if (data.status === 'error') {
                        alert(data.message);
                    }
                }
            });
        }

        function actualizarCantidad(idProducto, cantidad) {
            $.ajax({
                url: 'cliente/actualizar_cantidad_carrito.php',
                type: 'GET',
                data: {
                    id: idProducto,
                    cantidad: cantidad
                },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.status === 'success') {
                        actualizarCantidadCarrito();
                        location.reload(); // Recargar la página para reflejar cambios
                    } else if (data.status === 'error') {
                        alert(data.message);
                    }
                }
            });
        }

        function actualizarCantidadCarrito() {
            $.ajax({
                url: 'cliente/obtener_cantidad_carrito.php',
                type: 'GET',
                success: function(response) {
                    let data = JSON.parse(response);
                    $('.carrito-cantidad').text(data.cantidad);
                }
            });
        }
    </script>
</head>
<body>
    <header>
        <div class="logo">
            <a href="inicio_cliente.php"><img src="Assets/img/icono.png" alt="icono"></a>
        </div>
        <h2>INZUFRUT</h2>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="btn-get-started scrollto" href="Contactanos/contacta.php">Contactanos</a></li>
                <li><a class="btn-get-started scrollto" href="cliente/perfil_cliente.php">Ver Perfil</a></li>
            </ul>
            <div class="usuario-info">
                <div class="carrito-icono">
                    <a href="cliente/ver_carrito.php"><img src="Assets/img/cart.png" alt="Carrito"></a>
                    <span class="carrito-cantidad"><?= $cantidadProductosCarrito ?></span>
                </div>
                <a href="inicio_sesion/cerrar_sesion.php" id="cerrar-sesion">
                    <img src="Assets/img/cerrar-sesion.png" alt="icono cerrar sesión">
                </a>
            </div>
        </nav>
    </header>

    <h1>Nuestros Productos</h1>
    <div class="productos">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="producto">
                <img src="uploads/<?= $row['imagen']; ?>" alt="<?= $row['nom_product']; ?>">
                <h2><?= $row['nom_product'] ?></h2>
                <p><?= $row['descripcion'] ?></p>
                <strong>$<?= number_format($row['precio'], 2) ?></strong>
                <button onclick="agregarAlCarrito(<?= $row['id_producto'] ?>)">Agregar al Carrito</button>
            </div>
        <?php endwhile; ?>
    </div>
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
                window.location.href = "inicio_sesion/cerrar_sesion.php";
            }
        }

        // Agregar el evento click al enlace para cerrar sesión
        if (linkCerrarSesion) {
            linkCerrarSesion.addEventListener('click', confirmarCerrarSesion);
        }
    </script>
</body>
</html>
