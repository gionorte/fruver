<?php
session_start();
include '../conexion.php';

if (isset($_GET['id']) && isset($_GET['cantidad'])) {
    $id_producto = intval($_GET['id']);
    $nueva_cantidad = intval($_GET['cantidad']);

    // Obtener la cantidad en stock del producto
    $sql = "SELECT cantidad FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();
    $stmt->close();

    if ($producto) {
        $cantidadEnStock = $producto['cantidad'];

        // Verificar si hay suficiente stock
        if ($nueva_cantidad <= $cantidadEnStock) {
            if ($nueva_cantidad > 0) {
                $_SESSION['carrito'][$id_producto] = $nueva_cantidad;
            } else {
                unset($_SESSION['carrito'][$id_producto]);
            }

            // Obtener la cantidad total de productos en el carrito
            $cantidadProductosCarrito = array_sum($_SESSION['carrito']);

            echo json_encode(array("status" => "success", "cantidad" => $cantidadProductosCarrito));
        } else {
            echo json_encode(array("status" => "error", "message" => "Cantidad solicitada excede el stock disponible."));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Producto no encontrado."));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Datos incompletos."));
}
$conn->close();
?>
