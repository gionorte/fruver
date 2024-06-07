<?php
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'No has iniciado sesión']);
    exit();
}

$user_id = $_SESSION['user_id'];

include("conexion.php");

$sql = "SELECT Num_Doc, Tipo_Doc, Prim_Nombre, Seg_Nombre, Prim_Apellido, Seg_Apellido, Genero, Telefono, Correo FROM clientes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(['error' => 'No se encontraron datos']);
}

$stmt->close();
$conn->close();
?>