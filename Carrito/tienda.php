<?php
session_start();
include '../conexion.php';

$sql = "SELECT id_producto, nom_product, descripcion, estado, precio, imagen, cantidad FROM productos";
$result = $conn->query($sql);

// Obtener la cantidad de productos en el carrito
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
$cantidadProductosCarrito = count($carrito);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda en Línea</title>
    <link href="img/icon-p.png" rel="icon">
    <style>
        /* Estilo general */

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa; /* Color de fondo */
}

.container {
    width: 80%;
    margin: 0 auto;
}

/* Estilo del encabezado */

header {
    background-color: #343a40; /* Color de fondo del encabezado */
    color: #ffffff; /* Color de texto */
    padding: 20px 0;
    text-align: center;
}

.logo img {
    width: 60px;
    height: auto;
}

.logo a {
    color: #ffffff;
    text-decoration: none;
}

/* Estilo de navegación */

.navbar ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.navbar ul li {
    display: inline;
    margin-right: 20px;
}

.navbar ul li a {
    color: #ffffff;
    text-decoration: none;
}

/* Estilo de la sección principal */

.productos {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin-top: 20px;
}

.producto {
    width: 30%;
    margin-bottom: 20px;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.producto img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.producto h2 {
    font-size: 18px;
    margin-top: 10px;
}

.producto p {
    font-size: 14px;
    color: #666666;
}

.producto button {
    background-color: #007bff; /* Color del botón */
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 10px;
}

.producto button:hover {
    background-color: #0056b3; /* Color del botón al pasar el ratón */
}

/* Estilo del carrito de compras */

.carrito-icono {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
}

.carrito-icono img {
    width: 40px;
    height: auto;
    cursor: pointer;
}

.carrito-cantidad {
    background-color: #007bff; /* Color del contador */
    color: #ffffff;
    border-radius: 50%;
    padding: 5px 10px;
    font-size: 14px;
    position: absolute;
    top: -5px;
    right: -5px;
}

    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
   function agregarAlCarrito(idProducto) {
    $.ajax({
        url: 'agregar_carrito.php',
        type: 'GET',
        data: { id: idProducto },
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
        url: 'eliminar_del_carrito.php',
        type: 'GET',
        data: { id: idProducto },
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
        url: 'vaciar_carrito.php',
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
        url: 'actualizar_cantidad_carrito.php',
        type: 'GET',
        data: { id: idProducto, cantidad: cantidad },
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

$(document).ready(function() {
    actualizarCantidadCarrito();
});

function actualizarCantidadCarrito() {
    $.ajax({
        url: 'obtener_cantidad_carrito.php',
        type: 'GET',
        success: function(response) {
            let data = JSON.parse(response);
            if (data.status === 'success') {
                $('.carrito-cantidad').text(data.cantidad);
            }
        }
    });
}

</script>


</head>
<body>

    <main id="hero">
        <header>
            <div class="header-container">
                <div class="logo">
                    <h1 class="logo"><a href="inter-inicio.php"><img src="../img/icono.png" alt="icon" style="width: 60px;"></a></h1>
                </div>
                             
            </div>
            <h2 class="eri" style="text-align: left;">INZUFRUT</h2>   
            <i class="bi bi-list mobile-nav-toggle"></i> <!-- Icono de menú para dispositivos móviles -->
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="btn-get-started scrollto" href="../inter-inicio.php">Inicio</a></li>
                    <li><a class="btn-get-started scrollto" href="carrito/tienda.php">Productos</a></li>
                    <li><a class="btn-get-started scrollto" href="contactanos.php">Contactanos</a></li>
                    <li><a class="btn-get-started scrollto" href="registro_cliente.php">Registrate</a></li>
                </ul>
                <div class="carrito-icono">
        <a href="carrito.php">
            <img src="../img/cart.png" alt="Carrito de compras">
            <span class="carrito-cantidad"><?php echo $cantidadProductosCarrito; ?></span>
        </a>
    </div>
        </header>
    <h1>Tienda en Línea</h1>

    <div class="productos">
        <?php while($row = $result->fetch_assoc()) { ?>
            <div class="producto">
                <img src="../uploads/<?php echo $row['imagen']; ?>" alt="<?php echo $row['nom_product']; ?>">
                <h2><?php echo $row['nom_product']; ?></h2>
                <p><?php echo $row['descripcion']; ?></p>
                <p>Estado: <?php echo $row['estado']; ?></p>
                <p>Precio: $<?php echo $row['precio']; ?></p>
                <p>Stock: <?php echo $row['cantidad']; ?></p>
                <button onclick="agregarAlCarrito(<?php echo $row['id_producto']; ?>)">Agregar al Carrito</button>
            </div>
        <?php } ?>
    </div>
</main>
</body>
</html>

<?php
$conn->close();
?>