<?php
// Configuración de la base de datos
include("conexion.php");

// Variable para almacenar mensajes de error
$error = "";

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y sanearlos
    $correo = trim($_POST['correo']);
    $contrasena = trim($_POST['contrasena']);

    // Validar si los campos están vacíos
    if (empty($correo) || empty($contrasena)) {
        $error = "Por favor, ingresa tu correo electrónico y contraseña.";
    } else {
        // Sanitizar los datos para prevenir inyección SQL
        $correo = mysqli_real_escape_string($conn, $correo);
        $contrasena = mysqli_real_escape_string($conn, $contrasena);

        // Validar el formato del correo electrónico
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $error = "Formato de correo electrónico inválido.";
        } else {
            // Consulta SQL para verificar el usuario y la contraseña
            $sql = "SELECT Id_Cargo FROM persona WHERE Correo = '$correo' AND Contrasena = '$contrasena'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Inicio de sesión exitoso
                session_start();
                $row = $result->fetch_assoc();
                $_SESSION['correo'] = $correo;
                $_SESSION['Id_Cargo'] = $row['Id_Cargo']; // Guardar el cargo del usuario en la sesión
                header("Location: admin.php"); // Redirigir a la página de inicio
            } else {
                // Inicio de sesión fallido
                $error = "Correo electrónico o contraseña incorrectos.";
            }
        }
    }
}
?>
