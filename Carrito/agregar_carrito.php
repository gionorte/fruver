<?php
session_start();
include '../includes/conexion.php';

if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];

    // Obtener la cantidad en stock del producto
    $sql = "SELECT cantidad FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();

    if ($producto) {
        $cantidadEnCarrito = isset($_SESSION['carrito'][$id_producto]) ? $_SESSION['carrito'][$id_producto] : 0;
        $cantidadEnStock = $producto['cantidad'];

        // Verificar si hay suficiente stock
        if ($cantidadEnCarrito < $cantidadEnStock) {
            if (isset($_SESSION['carrito'][$id_producto])) {
                $_SESSION['carrito'][$id_producto]++;
            } else {
                $_SESSION['carrito'][$id_producto] = 1;
            }

            // Obtener la cantidad total de productos en el carrito
            $cantidadProductosCarrito = array_sum($_SESSION['carrito']);

            echo json_encode(array("status" => "success", "cantidad" => $cantidadProductosCarrito));
        } else {
            echo json_encode(array("status" => "error", "message" => "Producto agotado."));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Producto no encontrado."));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "ID del producto no proporcionado."));
}
$conn->close();
?>
