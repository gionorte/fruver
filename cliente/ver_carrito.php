<?php
session_start();
include '../includes/conexion.php';

if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../iniciosesion.php");
    exit();
}

// Inicializar variables para el carrito
$totalCarrito = 0;
$productosCarrito = [];

// Comprobar si hay productos en el carrito
if (!empty($_SESSION['carrito'])) {
    $idsProductos = array_keys($_SESSION['carrito']);
    $idsProductosString = implode(',', $idsProductos);

    if (!empty($idsProductosString)) {
        // Consultar los productos en el carrito
        $sql = "SELECT id_producto, nom_product, precio, imagen FROM productos WHERE id_producto IN ($idsProductosString)";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id_producto = $row['id_producto'];
                $row['cantidad_carrito'] = $_SESSION['carrito'][$id_producto];
                $productosCarrito[] = $row;
                $totalCarrito += $row['precio'] * $_SESSION['carrito'][$id_producto];
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Carrito de Compras</title>
    <link rel="stylesheet" href="../Assets/css/carrito.css">
</head>
<body>
    <h1>Carrito de Compras</h1>

<?php if (empty($productosCarrito)) : ?>
    <div id="emptyCartAlert">
        <p>El carrito está vacío.</p>
        <button onclick="window.location.href='../inicio_cliente.php'">Seguir comprando</button>
    </div>
<?php else : ?>
    <table>
        <tr>
            <th>Producto</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($productosCarrito as $producto) : ?>
            <tr>
                <td><?= $producto['nom_product']; ?></td>
                <td>$<?= number_format($producto['precio'], 2); ?></td>
                <td><?= $producto['cantidad_carrito']; ?></td>
                <td>$<?= number_format($producto['precio'] * $producto['cantidad_carrito'], 2); ?></td>
                <td>
                    <button onclick="actualizarCantidad(<?= $producto['id_producto']; ?>, <?= $producto['cantidad_carrito'] - 1; ?>)">-</button>
                    <button onclick="actualizarCantidad(<?= $producto['id_producto']; ?>, <?= $producto['cantidad_carrito'] + 1; ?>)">+</button>
                    <button onclick="eliminarDelCarrito(<?= $producto['id_producto']; ?>)">Eliminar</button>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th colspan="3"><strong>Total</strong></th>
            <td><strong>$<?= number_format($totalCarrito, 2); ?></strong></td>
            <td><button onclick="vaciarCarrito()">Vaciar Carrito</button></td>
        </tr>
    </table>

    <form action="orden_compra.php" method="POST">
        <button type="submit">Procesar Orden</button>
    </form>
    <button onclick="window.location.href='../inicio_cliente.php'">Seguir comprando</button>
<?php endif; ?>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function actualizarCantidad(idProducto, cantidad) {
            $.ajax({
                url: 'actualizar_cantidad_carrito.php',
                type: 'GET',
                data: {
                    id: idProducto,
                    cantidad: cantidad
                },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.status === 'success') {
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
                        location.reload(); // Recargar la página para reflejar cambios
                    } else if (data.status === 'error') {
                        alert(data.message);
                    }
                }
            });
        }
    </script>
</body>
</html>