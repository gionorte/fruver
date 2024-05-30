<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$action = $_POST['action'];

if ($action == 'add') {
    $product = $_POST['product'];
    $price = $_POST['price'];
    
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product'] == $product) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = ['product' => $product, 'price' => $price, 'quantity' => 1];
    }
} elseif ($action == 'remove') {
    $product = $_POST['product'];
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function($item) use ($product) {
        return $item['product'] != $product;
    });
} elseif ($action == 'clear') {
    $_SESSION['cart'] = [];
}

echo json_encode($_SESSION['cart']);
?>
