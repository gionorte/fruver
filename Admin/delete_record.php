<?php
include('conexion.php');

$num_doc = $_GET['num_doc'];

// Primero, eliminar los registros relacionados en la tabla empleado
$sql1 = "DELETE FROM empleado WHERE Num_Doc='$num_doc'";

if ($conn->query($sql1) === TRUE) {
    // Si tiene éxito, eliminar el registro de la tabla persona
    $sql2 = "DELETE FROM persona WHERE Num_Doc='$num_doc'";
    
    if ($conn->query($sql2) === TRUE) {
        header("Location: lista-empleados.php");
    } else {
        echo "Error al eliminar el registro de persona: " . $conn->error;
    }
} else {
    echo "Error al eliminar el registro de empleado: " . $conn->error;
}
?>
