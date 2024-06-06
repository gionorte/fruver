<?php
// procesar_asignacion.php

include("conexion.php");

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $num_doc = $_POST['num_doc'];
    $actividad = $_POST['actividad'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Validar los datos
    if (empty($num_doc) || empty($actividad) || empty($descripcion) || empty($fecha_inicio) || empty($fecha_fin)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Preparar y ejecutar la consulta para insertar la tarea en la base de datos
    $sql = "INSERT INTO tarea (Num_doc, Actividad, Descripcion, Fecha_Inicio, Fecha_Fin) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $num_doc, $actividad, $descripcion, $fecha_inicio, $fecha_fin);

    if ($stmt->execute()) {
        echo "Tarea asignada correctamente.";
    } else {
        echo "Error al asignar la tarea: " . $stmt->error;
    }

    // Cerrar la conexión y la declaración
    $stmt->close();
    $conn->close();
}
?>
