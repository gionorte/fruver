<?php
// procesar_suscripcion.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Incluir el archivo de conexión a la base de datos
        require 'conexion.php';

        try {
            // Verificar si la conexión se estableció correctamente
            if ($conn->connect_error) {
                echo json_encode(['status' => 'error', 'message' => 'No se pudo conectar a la base de datos.']);
                exit;
            }

            // Preparar la consulta SQL para insertar el email en la tabla suscripciones
            $stmt = $conn->prepare("INSERT INTO suscripciones (email) VALUES (?)");
            if ($stmt === false) {
                throw new Exception('Error en la preparación de la consulta: ' . $conn->error);
            }

            // Vincular los parámetros y ejecutar la declaración
            $stmt->bind_param('s', $email);
            if ($stmt->execute()) {
                // Devolver una respuesta JSON de éxito
                echo json_encode(['status' => 'success', 'message' => 'Gracias por suscribirte a nuestro boletín.']);
            } else {
                throw new Exception('Error en la ejecución de la consulta: ' . $stmt->error);
            }

            // Cerrar la declaración
            $stmt->close();
        } catch (Exception $e) {
            // Si hay un error, devolver una respuesta JSON de error
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        // Si el email no es válido, devolver una respuesta JSON de error
        echo json_encode(['status' => 'error', 'message' => 'Por favor, ingresa un correo electrónico válido.']);
    }
} else {
    // Si el método de solicitud no es POST, devolver una respuesta JSON de error
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no permitido.']);
}
?>
