<?php
session_start();

$cantidadProductosCarrito = isset($_SESSION['carrito']) ? array_sum($_SESSION['carrito']) : 0;

echo json_encode(array("status" => "success", "cantidad" => $cantidadProductosCarrito));
?>
