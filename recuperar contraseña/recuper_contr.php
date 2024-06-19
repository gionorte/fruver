<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

require_once('../includes/conexion.php');

$email = $_POST['email'];
$query = "SELECT * FROM persona WHERE Correo = '$email'";
$result = $conn->query($query); 

if ($result->num_rows > 0) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp-mail.outlook.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'inzufruts.a.s@outlook.com';
        $mail->Password   = 'Inzufrut2024*';
        $mail->Port       = 587;

        // Remitente y destinatarios
        $mail->setFrom('inzufruts.a.s@outlook.com', 'Inzufrut');
        $mail->addAddress($email, $row['Prim_Nombre'] . ' ' . $row['Prim_Apellido']); // Usando Prim_Nombre y Prim_Apellido

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de contraseña';
        $mail->Body    = 'Hola ' . $row['Prim_Nombre'] . ', este es un correo generado para solicitar tu recuperación de contraseña. Por favor, visita la página de <a href="http://localhost/Inzufrut-1/recuperar%20contrase%C3%B1a/cambiar_contrase%C3%B1a.php?id=' . $row['Num_Doc'] . '">Recuperación de contraseña</a>';

        $mail->send();
        header("Location: ../inicio sesion/iniciosesion.php?message=ok");
    } catch (Exception $e) {
        header("Location: ../inicio sesion/iniciosesion.php?message=error");
    }
} else {
    header("Location: ../inicio sesion/iniciosesion.php?message=not_found");
}
?>