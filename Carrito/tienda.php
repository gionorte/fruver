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
        body,
html {
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

.header-container {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
}

.header-container h2 {
  order: 1;
}

.contact-info {
  display: flex;
  align-items: center;
  order: 3;
}

.contact-info a {
  text-decoration: none;
  color: #333;
  margin-left: 10px;
}

/* Logo Styles */
.logo img {
  width: 60px;
  height: auto;
}

/* Navbar Styles */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.navbar ul {
  display: flex;
  list-style-type: none;
}

.navbar li {
  margin-right: 20px;
}

@media (max-width: 600px) {
  #navbar ul {
    display: none;
  }

  .hamburger {
    display: block;
  }
}

/* Button Styles */
.btn-get-started {
  padding: 10px 20px;
  background-color: #ffa500;
  color: #fff;
  border: none;
  border-radius: 5px;
  text-decoration: none;
}

.btn-get-started:hover {
  background-color: #ff8c00;
}

/* Cart Icon Styles */
.cart-icon {
  position: relative;
  cursor: pointer;
  display: inline-block;
  margin-left: 20px;
}

.cart-icon img {
  width: 40px;
}

.cart-count {
  position: absolute;
  top: -10px;
  right: -10px;
  background: orange;
  color: white;
  border-radius: 50%;
  padding: 5px;
  font-size: 12px;
}

/* Profile Icon Styles */
.profile-icon {
  position: relative;
  cursor: pointer;
  display: inline-block;
  margin-left: 20px;
}

.profile-icon img {
  width: 40px;
}

/* Mobile Hamburger Menu */
.hamburger {
  display: none;
}

/* General Styles */
.contact-info {
  display: flex;
  align-items: center;
}

@media (max-width: 600px) {
  .header-container {
    flex-direction: column;
  }
}

.hamburger {
  display: block;
}

.contact-info a {
  text-decoration: none;
  color: #333;
  margin-left: 10px;
}

header .logo h1 {
  margin: 0;
}

header .logo a {
  display: inline-block;
}

header .logo img {
  width: 60px;
}

.header-container h2 {
  margin: 0 10px;
}


body,
html {
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

.header-container {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
}

.header-container h2 {
  order: 1;
}

.contact-info {
  display: flex;
  align-items: center;
  order: 3;
}

.contact-info a {
  text-decoration: none;
  color: #333;
  margin-left: 10px;
}

/* Logo Styles */
.logo img {
  width: 60px;
  height: auto;
}

/* Navbar Styles */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.navbar ul {
  display: flex;
  list-style-type: none;
}

.navbar li {
  margin-right: 20px;
}

@media (max-width: 600px) {
  #navbar ul {
    display: none;
  }

  .hamburger {
    display: block;
  }
}

/* Button Styles */
.btn-get-started {
  padding: 10px 20px;
  background-color: #ffa500;
  color: #fff;
  border: none;
  border-radius: 5px;
  text-decoration: none;
}

.btn-get-started:hover {
  background-color: #ff8c00;
}

/* Cart Icon Styles */
.cart-icon {
  position: relative;
  cursor: pointer;
  display: inline-block;
  margin-left: 20px;
}

.cart-icon img {
  width: 40px;
}

.cart-count {
  position: absolute;
  top: -10px;
  right: -10px;
  background: orange;
  color: white;
  border-radius: 50%;
  padding: 5px;
  font-size: 12px;
}

/* Profile Icon Styles */
.profile-icon {
  position: relative;
  cursor: pointer;
  display: inline-block;
  margin-left: 20px;
}

.profile-icon img {
  width: 40px;
}

/* Mobile Hamburger Menu */
.hamburger {
  display: none;
}

/* General Styles */
.contact-info {
  display: flex;
  align-items: center;
}

@media (max-width: 600px) {
  .header-container {
    flex-direction: column;
  }
}

.hamburger {
  display: block;
}

.contact-info a {
  text-decoration: none;
  color: #333;
  margin-left: 10px;
}

header .logo h1 {
  margin: 0;
}

header .logo a {
  display: inline-block;
}

header .logo img {
  width: 60px;
}

.header-container h2 {
  margin: 0 10px;
}

/* Product Section Styles */
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
  display: inline-block;
  text-align: center;
  vertical-align: top;
  margin: 20px;
  padding: 20px;
  border: 8px solid #fa8f03;
  border-radius: 10px;
  background-color: #fff;
  box-shadow: 0 4px 8px rgb(243, 139, 3);
  max-width: 300px;
}

.producto img {
  max-width: 90%;
  height: auto;
  border-radius: 5px;
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

@media (max-width: 600px) {
  .productos {
    flex-direction: column;
    align-items: center;
  }
}
/* Cart Icon Styles */
.carrito-icono {
  position: relative;
  cursor: pointer;
  display: inline-block;
  margin-left: 20px; /* Adjust the margin as needed */
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

/* Additional Styles for Hover and Focus States */
.carrito-icono a {
  display: block;
  text-decoration: none;
}

.carrito-icono:hover .carrito-cantidad,
.carrito-icono:focus .carrito-cantidad {
  background: #ff8c00;
}

/* Optional: Add a transition for a smoother hover effect */
.carrito-cantidad {
  transition: background 0.3s ease;
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