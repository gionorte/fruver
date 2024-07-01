<?php
session_start();

$id_producto = $_GET['id'];

if(isset($_SESSION['carrito'][$id_producto])) {
    unset($_SESSION['carrito'][$id_producto]);
    $cantidadProductosCarrito = count($_SESSION['carrito']);
    echo json_encode(array('status' => 'success', 'cantidad' => $cantidadProductosCarrito));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Producto no encontrado en el carrito'));
}
?>
