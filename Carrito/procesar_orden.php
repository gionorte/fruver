<?php
session_start();
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_cliente = $_POST['nom_cliente'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $tipo_doc = $_POST['tipo_doc'];
    $num_doc = $_POST['num_doc'];
    $total_carrito = $_POST['total_carrito'];

    // Insertar en la tabla de ordenes
    $sql = "INSERT INTO ordenes (nom_cliente, telefono, correo, tipo_doc, num_doc, total) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nom_cliente, $telefono, $correo, $tipo_doc, $num_doc, $total_carrito);
    $stmt->execute();
    $id_orden = $stmt->insert_id;
    $stmt->close();

    // Insertar en la tabla de detalles de orden
    foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
        $sql = "SELECT nom_product, descripcion, precio FROM productos WHERE id_producto = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $result = $stmt->get_result();
        $producto = $result->fetch_assoc();
        $stmt->close();

        if ($producto) {
            $nom_product = $producto['nom_product'];
            $descripcion = $producto['descripcion'];
            $precio = $producto['precio'];

            $sql = "INSERT INTO detalles_orden (id_orden, nom_product, descripcion, cantidad, precio, id_producto) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issiii", $id_orden, $nom_product, $descripcion, $cantidad, $precio, $id_producto);
            $stmt->execute();
            $stmt->close();

            // Actualizar el stock del producto
            $sql = "UPDATE productos SET cantidad = cantidad - ? WHERE id_producto = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $cantidad, $id_producto);
            $stmt->execute();
            $stmt->close();
        }
    }

    // Vaciar el carrito después de procesar la orden
    $_SESSION['carrito'] = [];

    echo "Orden creada con éxito. ID de la orden: " . $id_orden;
} else {
    echo "Método de solicitud no válido.";
}

$conn->close();
?>
