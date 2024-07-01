<?php
session_start();
include("../includes/conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $num_doc = isset($_POST['num_doc']) ? $_POST['num_doc'] : '';
    $tipo_doc = isset($_POST['tipo_doc']) ? $_POST['tipo_doc'] : '';
    $prim_nombre = isset($_POST['prim_nombre']) ? $_POST['prim_nombre'] : '';
    $seg_nombre = isset($_POST['seg_nombre']) ? $_POST['seg_nombre'] : '';
    $prim_apellido = isset($_POST['prim_apellido']) ? $_POST['prim_apellido'] : '';
    $seg_apellido = isset($_POST['seg_apellido']) ? $_POST['seg_apellido'] : '';
    $genero = isset($_POST['genero']) ? $_POST['genero'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';
    $id_cargo = 3; // Valor fijo para clientes

    // Verificar si todos los campos requeridos están presentes
    if (empty($num_doc) || empty($tipo_doc) || empty($prim_nombre) || empty($prim_apellido) || empty($telefono) || empty($correo) || empty($contrasena)) {
        echo "Por favor completa todos los campos obligatorios.";
        exit();
    }

    // Insertar datos en la base de datos
    $sql = "INSERT INTO persona (Num_Doc, Tipo_Doc, Prim_Nombre, Seg_Nombre, Prim_Apellido, Seg_Apellido, Genero, Telefono, Correo, Contrasena, Id_Cargo)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssi", $num_doc, $tipo_doc, $prim_nombre, $seg_nombre, $prim_apellido, $seg_apellido, $genero, $telefono, $correo, $contrasena, $id_cargo);

    // Ejecutar la declaración
    if ($stmt->execute()) {
        // Redirigir a la página de registro con una notificación de éxito
        header("Location: registro_cliente.php?success=true");
        exit();
    } else {
        echo "Error al registrar el cliente: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirigir a la página de registro si se accede directamente al script
    header("Location: registro_cliente.php");
    exit();
}
?>
