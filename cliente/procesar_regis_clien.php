<?php
session_start();
include("../includes/conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $num_doc = $_POST['num_doc'];
    $tipo_doc = $_POST['tipo_doc'];
    $prim_nombre = $_POST['prim_nombre'];
    $seg_nombre = $_POST['seg_nombre'];
    $prim_apellido = $_POST['prim_apellido'];
    $seg_apellido = $_POST['seg_apellido'];
    $genero = $_POST['genero'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
    $id_cargo = 3; // Valor fijo para clientes

    // Insertar datos en la base de datos
    $sql = "INSERT INTO persona (Num_Doc, Tipo_Doc, Prim_Nombre, Seg_Nombre, Prim_Apellido, Seg_Apellido, Genero, Telefono, Correo, Contrasena, Id_Cargo)
            VALUES ('$num_doc', '$tipo_doc', '$prim_nombre', '$seg_nombre', '$prim_apellido', '$seg_apellido', '$genero', '$telefono', '$correo', '$contrasena', '$id_cargo')";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página de registro con una notificación de éxito
        header("Location: registro_cliente.php?success=true");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    // Redirigir a la página de registro si se accede directamente al script
    header("Location: registro_cliente.php");
    exit();
}
?>
