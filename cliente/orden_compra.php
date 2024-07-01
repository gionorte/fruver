<?php
session_start();
include '../includes/conexion.php';

if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../iniciosesion.php");
    exit();
}

// Recuperar los detalles de los productos en el carrito
$productosCarrito = [];
$totalCarrito = 0;

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
    <title>Confirmación de Orden de Compra</title>
    <link rel="stylesheet" href="../Assets/css/orden_compra.css">
</head>
<body>
    <h1>Confirmación de Orden de Compra</h1>

    <div class="detalles-carrito">
        <h2>Detalles del Carrito</h2>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productosCarrito as $producto) : ?>
                    <tr>
                        <td><?= $producto['nom_product']; ?></td>
                        <td>$<?= number_format($producto['precio'], 2); ?></td>
                        <td><?= $producto['cantidad_carrito']; ?></td>
                        <td>$<?= number_format($producto['precio'] * $producto['cantidad_carrito'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td><strong>$<?= number_format($totalCarrito, 2); ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>

<form action="pagar.php" method="POST" enctype="multipart/form-data">
    <label for="comprobante">Subir Comprobante de Pago (solo imágenes):</label>
    <input type="file" name="comprobante" id="comprobante" accept="image/jpeg, image/png, image/gif" required>
    <br>
    <input type="hidden" name="total" value="<?= $totalCarrito; ?>">
    <button type="submit">Confirmar Compra</button>
</form>>

    <div class="qr-code">
        <h2>Código QR de Pago</h2>
        <p>Escanea este código QR para realizar el pago:</p>
        <img src="../Assets/img/Nequi.jpg" width="180" alt="QR Nequi">
    </div>
</body>
</html>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../Assets/js/qrious.js"></script>
    <script>
        $(document).ready(function() {
            // Obtener el total de la compra
            var totalCompra = <?= $totalCarrito; ?>;
            
            // Generar el código QR
            var qr = new QRious({
                element: document.getElementById('qr-container'),
                value: '../Assets/img/Nequi.jpg', // Aquí deberías colocar el valor o la URL de pago dinámico
                size: 300
            });
        });
    </script>
</body>
</html>
