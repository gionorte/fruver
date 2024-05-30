<?php
header('Content-Type: application/json');
include("conexion.php"); // Asegúrate de que este archivo establece la conexión con tu base de datos

session_start();

if (!isset($_SESSION['correo'])) {
    echo json_encode(["error" => "Usuario no autenticado"]);
    exit();
}

$correo = $_SESSION['correo'];

$sql = "SELECT Num_Doc, Tipo_Doc, Prim_Nombre, Seg_Nombre, Prim_Apellido, Seg_Apellido, Genero, Telefono, Correo FROM clientes WHERE Correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(["error" => "No se encontraron datos del cliente"]);
}

$stmt->close();
$conn->close();
?>
