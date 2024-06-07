<?php
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'No has iniciado sesión']);
    exit();
}

$user_id = $_SESSION['user_id'];

$prim_nombre = $_POST['Prim_Nombre'];
$seg_nombre = $_POST['Seg_Nombre'];
$prim_apellido = $_POST['Prim_Apellido'];
$seg_apellido = $_POST['Seg_Apellido'];
$telefono = $_POST['Telefono'];
$correo = $_POST['Correo'];

include("conexion.php");

$sql = "UPDATE clientes SET Prim_Nombre = ?, Seg_Nombre = ?, Prim_Apellido = ?, Seg_Apellido = ?, Telefono = ?, Correo = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssi", $prim_nombre, $seg_nombre, $prim_apellido, $seg_apellido, $telefono, $correo, $user_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar el perfil']);
}

$stmt->close();
$conn->close();
?>
