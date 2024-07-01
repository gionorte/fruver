<?php
// Incluir archivo de conexión a la base de datos
include('../includes/conexion.php');

$sql = "SELECT Mensaje, Fecha FROM notificaciones WHERE Leido = FALSE ORDER BY fecha DESC";
$result = $conn->query($sql);

if ($result === false) {
    echo json_encode(['success' => false, 'message' => 'Error al obtener las notificaciones: ' . $conn->error]);
    exit();
}

$notificaciones = [];

while ($row = $result->fetch_assoc()) {
    $notificaciones[] = $row;
}

echo json_encode($notificaciones);
?>