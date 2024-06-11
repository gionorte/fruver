<?php
session_start();
include '../conexion.php';

// Inicializar total del carrito
$totalCarrito = 0;

// Inicializar productos del carrito
$productosCarrito = [];

// Comprobar si hay productos en el carrito
if (!empty($_SESSION['carrito'])) {
    $idsProductos = array_keys($_SESSION['carrito']);
    $idsProductosString = implode(',', $idsProductos);

    if (!empty($idsProductosString)) {
        // Consultar los productos en el carrito
        $sql = "SELECT id_producto, nom_product, cantidad, precio, imagen FROM productos WHERE id_producto IN ($idsProductosString)";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (isset($row['id_producto'])) {
                    $id_producto = $row['id_producto'];
                    if (isset($_SESSION['carrito'][$id_producto])) {
                        $cantidad_carrito = $_SESSION['carrito'][$id_producto];
                        $row['cantidad_carrito'] = $cantidad_carrito;
                        $productosCarrito[] = $row;
                        if (isset($row['precio'])) {
                            $totalCarrito += $row['precio'] * $cantidad_carrito;
                        }
                    }
                }
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
    <title>Carrito de Compras</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/script.js"></script>
</head>
<body>
    <h1>Carrito de Compras</h1>

    <?php if (empty($productosCarrito)) { ?>
        <p>El carrito está vacío.</p>
    <?php } else { ?>
        <table>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($productosCarrito as $producto) { ?>
                <tr>
                    <td><?php echo isset($producto['nom_product']) ? $producto['nom_product'] : ''; ?></td>
                    <td>$<?php echo isset($producto['precio']) ? $producto['precio'] : ''; ?></td>
                    <td>
                        <button onclick="actualizarCantidad(<?php echo $producto['id_producto']; ?>, <?php echo $producto['cantidad_carrito'] - 1; ?>)">-</button>
                        <?php echo isset($producto['cantidad_carrito']) ? $producto['cantidad_carrito'] : ''; ?>
                        <button onclick="actualizarCantidad(<?php echo $producto['id_producto']; ?>, <?php echo $producto['cantidad_carrito'] + 1; ?>)">+</button>
                    </td>
                    <td>$<?php echo isset($producto['precio']) ? $producto['precio'] * $producto['cantidad_carrito'] : ''; ?></td>
                    <td><button onclick="eliminarDelCarrito(<?php echo $producto['id_producto']; ?>)">Eliminar</button></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3">Total</td>
                <td>$<?php echo $totalCarrito; ?></td>
                <td></td>
            </tr>
        </table>
        <form action="orden_compra.php" method="post">
            <input type="hidden" name="total" value="<?php echo $totalCarrito; ?>">
            <button type="submit">Pagar</button>
        </form>
        <button onclick="vaciarCarrito()">Vaciar Carrito</button>
    <?php } ?>
</body>
</html>
