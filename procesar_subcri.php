<?php
// procesar_suscripcion.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Incluir el archivo de conexión a la base de datos
        require 'conexion.php';

        try {
            // Preparar la consulta SQL para insertar el email en la tabla suscripciones
            $stmt = $pdo->prepare("INSERT INTO suscripciones (email) VALUES (:email)");
            $stmt->execute(['email' => $email]);

            // Devolver una respuesta JSON de éxito
            echo json_encode(['status' => 'success', 'message' => 'Gracias por suscribirte a nuestro boletín.']);
        } catch (PDOException $e) {
            // Si hay un error, devolver una respuesta JSON de error
            echo json_encode(['status' => 'error', 'message' => 'No se pudo procesar tu suscripción. Inténtalo de nuevo más tarde.']);
        }
    } else {
        // Si el email no es válido, devolver una respuesta JSON de error
        echo json_encode(['status' => 'error', 'message' => 'Por favor, ingresa un correo electrónico válido.']);
    }
} else {
    // Si el método de solicitud no es POST, devolver una respuesta JSON de error
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no permitido.']);
}
?>
