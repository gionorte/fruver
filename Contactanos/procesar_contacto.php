<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar y sanitizar los datos del formulario
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Verificar que todos los campos estén completos
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        // Configurar los encabezados del correo electrónico
        $to = 'tovarpabon2301@gmail.com'; // Dirección de correo electrónico de destino
        $headers = "From: $email" . "\r\n" .
                   "Reply-To: $email" . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        // Enviar el correo electrónico
        if (mail($to, $subject, $message, $headers)) {
            echo json_encode(['status' => 'success', 'message' => 'Tu mensaje ha sido enviado. ¡Gracias!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo enviar el mensaje. Inténtalo de nuevo más tarde.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Por favor, completa todos los campos del formulario.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no permitido.']);
}
?>
