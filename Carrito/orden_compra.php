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
    <title>Orden de Compra</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/script.js"></script>
</head>
<body>
    <h1>Orden de Compra</h1>

    <?php if (empty($productosCarrito)) { ?>
        <p>El carrito está vacío.</p>
    <?php } else { ?>
        <form action="procesar_orden.php" method="POST">
            <h2>Detalles del Cliente</h2>
            <label for="nom_cliente">Nombre:</label>
            <input type="text" id="nom_cliente" name="nom_cliente" required><br>
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required><br>
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required><br>
            <label for="tipo_doc">Tipo de Documento:</label>
            <select id="tipo_doc" name="tipo_doc" >
                        <?php
                        include("../conexion.php");
                        $sql_tipo_documento = "SELECT * FROM tipo_documento";
                        $result_tipo_documento = $conn->query($sql_tipo_documento);
                        while($row_tipo_doc = $result_tipo_documento->fetch_assoc()) {
                            echo "<option value='" . $row_tipo_doc['Tipo_Doc'] . "'>" . $row_tipo_doc['Tipo_Doc'] . "</option>";
                        }
                        ?>
                    </select><br>
            <label for="num_doc">Número de Documento:</label>
            <input type="text" id="num_doc" name="num_doc" required><br>

            <h2>Productos en el Carrito</h2>
            <table>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
                <?php foreach ($productosCarrito as $producto) { ?>
                    <tr>
                        <td><?php echo isset($producto['nom_product']) ? $producto['nom_product'] : ''; ?></td>
                        <td>$<?php echo isset($producto['precio']) ? $producto['precio'] : ''; ?></td>
                        <td><?php echo isset($producto['cantidad_carrito']) ? $producto['cantidad_carrito'] : ''; ?></td>
                        <td>$<?php echo isset($producto['precio']) ? $producto['precio'] * $producto['cantidad_carrito'] : ''; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="3">Total</td>
                    <td>$<?php echo $totalCarrito; ?></td>
                </tr>
            </table>

            <input type="hidden" name="total_carrito" value="<?php echo $totalCarrito; ?>">
            <button type="submit">Realizar Orden</button>
        </form>
    <?php } ?>
</body>
</html>
