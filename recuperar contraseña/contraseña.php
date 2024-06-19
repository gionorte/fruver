<?php
session_start();
include '../includes/conexion.php';

if (isset($_GET['id'])) {
    $email = $_GET['id'];
    $_SESSION['email'] = $email;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        header("Location: cambiar_contraseña.php?message=password_mismatch");
        exit();
    }

    // Hash de la nueva contraseña
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    // Actualizar la contraseña en la base de datos
    $query = "UPDATE persona SET Contrasena = ? WHERE Correo = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('ss', $hashed_password, $_SESSION['email']);

    if ($stmt->execute()) {
        // Redirigir con un mensaje de éxito
        header("Location: iniciosesion.php?message=success_password");
    } else {
        // Redirigir con un mensaje de error
        header("Location: iniciosesion.php?message=error_password");
    }
    $stmt->close();
    $conexion->close();
}
?>