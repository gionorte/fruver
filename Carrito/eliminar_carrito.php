<?php
session_start();

if (isset($_POST['id'])) {
    $idProducto = $_POST['id'];

    // Verificar si el producto está en el carrito
    if (isset($_SESSION['carrito'][$idProducto])) {
        // Eliminar el producto del carrito
        unset($_SESSION['carrito'][$idProducto]);
    }
}

echo json_encode(['status' => 'success']);
?>
