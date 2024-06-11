
<?php
session_start();
$_SESSION['carrito'] = [];
echo json_encode(['status' => 'success']);
?>
