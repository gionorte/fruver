<?php
session_start();
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar los datos del formulario
    $tipo_doc = limpiar($_POST["tipo_doc"]);
    $num_doc = limpiar($_POST["num_doc"]);
    $nom_cliente = limpiar($_POST["nom_cliente"]);
    $telefono = limpiar($_POST["telefono"]);
    $correo = limpiar($_POST["correo"]);

    // Insertar la información del cliente en la tabla de órdenes de compra
    $sql_insert_cliente = "INSERT INTO orden_compra (Tipo_Doc, Num_Doc, Nom_Cliente, Telefono, Correo) VALUES ('$tipo_doc', '$num_doc', '$nom_cliente', '$telefono', '$correo')";
    if ($conn->query($sql_insert_cliente) === TRUE) {
        // Obtener el ID de la orden recién insertada
        $id_orden = $conn->insert_id;

        // Recorrer los productos en el carrito y registrarlos en la tabla de detalles de la orden de compra
        foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
            // Obtener el precio del producto
            $sql_precio = "SELECT precio FROM productos WHERE id_producto = $id_producto";
            $result_precio = $conn->query($sql_precio);
            $row_precio = $result_precio->fetch_assoc();
            $precio = $row_precio['precio'];

            // Insertar el detalle de la orden de compra
            $sql_insert_detalle = "INSERT INTO orden_compra (Id_Orden, Id_Producto, Cantidad_Product, Precio) VALUES ($id_orden, $id_producto, $cantidad, $precio)";
            $conn->query($sql_insert_detalle);

            // Actualizar la cantidad de productos en la tabla de inventario
            $sql_actualizar_inventario = "UPDATE productos SET cantidad = cantidad - $cantidad WHERE id_producto = $id_producto";
            $conn->query($sql_actualizar_inventario);
        }

        // Limpiar el carrito después de completar la compra
        unset($_SESSION['carrito']);

        echo "La orden de compra se ha realizado con éxito.";
    } else {
        echo "Error al registrar la orden de compra: " . $conn->error;
    }
}

function limpiar($dato) {
    // Limpiar los datos recibidos del formulario
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Compra</title>
</head>
<body>
    <h1>Finalizar Compra</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="tipo_doc">Tipo de Documento:</label>
        <input type="text" name="tipo_doc" required><br>
        <label for="num_doc">Número de Documento:</label>
        <input type="text" name="num_doc" required><br>
        <label for="nom_cliente">Nombre del Cliente:</label>
        <input type="text" name="nom_cliente" required><br>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" required><br>
        <label for="correo">Correo:</label>
        <input type="email" name="correo" required><br>
        <br>
        <input type="submit" value="Finalizar Compra">
    </form>
</body>
</html>

<?php
$conn->close();
?>
