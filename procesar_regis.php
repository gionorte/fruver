<?php
session_start();
if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: iniciosesion.php");
    exit();
}

include("conexion.php");

// Recibir datos del formulario
$num_doc = $_POST['num_doc'];
$correo = $_POST['correo'];

// Consulta SQL para verificar si el número de documento ya existe
$sql_verif_num_doc = "SELECT COUNT(*) AS num_rows FROM persona WHERE Num_Doc = '$num_doc'";
$result_verif_num_doc = $conn->query($sql_verif_num_doc);
$row_verif_num_doc = $result_verif_num_doc->fetch_assoc();

// Consulta SQL para verificar si el correo electrónico ya existe
$sql_verif_correo = "SELECT COUNT(*) AS num_rows FROM persona WHERE Correo = '$correo'";
$result_verif_correo = $conn->query($sql_verif_correo);
$row_verif_correo = $result_verif_correo->fetch_assoc();

// Si ya existe un registro con el número de documento o el correo electrónico, mostrar un mensaje de error
if ($row_verif_num_doc['num_rows'] > 0) {
    echo "Error: El número de documento ya está registrado.";
} elseif ($row_verif_correo['num_rows'] > 0) {
    echo "Error: El correo electrónico ya está registrado.";
} else {
    // Si no hay registros existentes, proceder con el registro
    // Recibir los demás datos del formulario y realizar la inserción en la base de datos
    $tipo_doc = $_POST['tipo_doc'];
    $prim_nombre = $_POST['prim_nombre'];
    $seg_nombre = $_POST['seg_nombre'];
    $prim_apellido = $_POST['prim_apellido'];
    $seg_apellido = $_POST['seg_apellido'];
    $genero = $_POST['genero'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];
    $id_cargo = $_POST['id_cargo'];
    $salario = $_POST['salario'];

    // Consulta SQL para insertar los datos en la tabla persona
    $sql_insert_persona = "INSERT INTO persona (Num_Doc, Tipo_Doc, Prim_Nombre, Seg_Nombre, Prim_Apellido, Seg_Apellido, Genero, Telefono, Correo, Contrasena) 
                   VALUES ('$num_doc', '$tipo_doc', '$prim_nombre', '$seg_nombre', '$prim_apellido', '$seg_apellido', '$genero', '$telefono', '$correo', '$contrasena')";

    if ($conn->query($sql_insert_persona) === TRUE) {
        $id_empleado = $conn->insert_id; // Get the last inserted id for the persona

        // Consulta SQL para insertar los datos en la tabla empleado
        $sql_insert_empleado = "INSERT INTO empleado (Id_Empleado, Num_Doc, Salario, Id_Cargo) 
                                VALUES ('$id_empleado', '$num_doc', '$salario', '$id_cargo')";

        if ($conn->query($sql_insert_empleado) === TRUE) {
            // Establecer variable de sesión para indicar registro exitoso
            $_SESSION['registro_exitoso'] = true;
            header("Location: registrar.php");
        } else {
            echo "Error: " . $sql_insert_empleado . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql_insert_persona . "<br>" . $conn->error;
    }
}

$conn->close();
?>
