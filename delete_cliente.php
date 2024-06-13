<?php
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'No has iniciado sesión']);
    exit();
}

$user_id = $_SESSION['user_id'];

include("conexion.php");

$sql = "DELETE FROM clientes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    
    session_destroy();
    echo json_encode(['success' => true]);
} else {
    $stmt->close();
    $conn->close();

    echo json_encode(['success' => false, 'message' => 'Error al eliminar el perfil']);
}
?>