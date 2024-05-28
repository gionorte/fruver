<?php
// procesar_contacto.php

// Configurar el servidor SMTP y el puerto SMTP
ini_set('SMTP', 'locahost');
ini_set('smtp_port', '587');

// Resto del código...

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Valida los datos
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Datos válidos, procesa el envío del correo
        $to = 'tovarpabon2301@gmail.com'; // Dirección de correo de destino
        $headers = "From: $name <$email>" . "\r\n" .
                   "Reply-To: $email" . "\r\n" .
                   "Content-type: text/plain; charset=utf-8";
        $body = "Nombre: $name\nEmail: $email\nAsunto: $subject\n\nMensaje:\n$message";

        if (mail($to, $subject, $body, $headers)) {
            // Éxito en el envío
            echo json_encode(['status' => 'success', 'message' => 'Tu mensaje ha sido enviado. ¡Gracias!']);
        } else {
            // Error en el envío
            echo json_encode(['status' => 'error', 'message' => 'Hubo un problema al enviar tu mensaje. Inténtalo de nuevo más tarde.']);
        }
    } else {
        // Datos inválidos
        echo json_encode(['status' => 'error', 'message' => 'Por favor, completa todos los campos correctamente.']);
    }
} else {
    // Acceso no permitido
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no permitido.']);
}
?>
