<?php
session_start();

if (isset($_SESSION['carrito'])) {
    unset($_SESSION['carrito']);
}

echo json_encode(['status' => 'success']);
?>
