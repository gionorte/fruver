<?php
session_start();
include 'conexion.php';

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
    <link rel="stylesheet" href="Assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
    /* Reset and Global Styles */
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
  margin: 0 10px;
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

.logo img {
  width: 60px;
  height: auto;
}

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
  .navbar ul {
    display: none;
  }

  .header-container {
    flex-direction: column;
  }

  .hamburger {
    display: block;
  }
}

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

.cart-icon,
.profile-icon {
  position: relative;
  cursor: pointer;
  display: inline-block;
  margin-left: 20px;
}

.cart-icon img,
.profile-icon img {
  width: 40px;
  height: auto;
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
  font-weight: bold;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.3s ease;
}

.cart-icon:hover .cart-count,
.cart-icon:focus .cart-count {
  background: #ff8c00;
}

.hamburger {
  display: none;
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
  transition: background 0.3s ease;
}

.carrito-icono a {
  display: block;
  text-decoration: none;
}

.carrito-icono:hover .carrito-cantidad,
.carrito-icono:focus .carrito-cantidad {
  background: #ff8c00;
}

</style>
    <script>
    function agregarAlCarrito(idProducto) {
      $.ajax({
        url: '../Carrito/agregar_carrito.php',
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
        url: '../Carrito/eliminar_del_carrito.php',
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
        url: '../Carrito/vaciar_carrito.php',
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
        url: '../Carrito/actualizar_cantidad_carrito.php',
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

    $(document).ready(function() {
      actualizarCantidadCarrito();
    });

    function actualizarCantidadCarrito() {
      $.ajax({
        url: '../Carrito/obtener_cantidad_carrito.php',
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
    <script>
    function agregarAlCarrito(idProducto) {
        $.ajax({
            url: '../Carrito/agregar_carrito.php',
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
            url: 'eliminar_del_carrito.php',
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
            url: '../Carrito/vaciar_carrito.php',
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
            url: '../Carrito/actualizar_cantidad_carrito.php',
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

    $(document).ready(function() {
        actualizarCantidadCarrito();
    });

    function actualizarCantidadCarrito() {
        $.ajax({
            url: '../Carrito/obtener_cantidad_carrito.php',
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
<header>
    <div class="header-container">
        <div class="logo">
            <img src="path/to/logo.png" alt="Logo">
        </div>
        <h2>Tienda en Línea</h2>
        <div class="contact-info">
            <a href="#">Contacto</a>
            <div class="cart-icon">
                <img src="path/to/cart-icon.png" alt="Carrito">
                <span class="cart-count"><?php echo $cantidadProductosCarrito; ?></span>
            </div>
        </div>
    </div>
</header>

<main>
    <h1>Tienda en Línea</h1>
    <div class="productos">
        <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="producto">
            <img src="uploads/<?php echo $row['imagen']; ?>" alt="<?php echo $row['nom_product']; ?>">
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