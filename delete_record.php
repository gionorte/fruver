<?php
include('conexion.php');

$num_doc = $_GET['num_doc'];

// First, delete related records in the empleado table
$sql1 = "DELETE FROM empleado WHERE Num_Doc='$num_doc'";

if ($conn->query($sql1) === TRUE) {
    // If successful, delete the record from the persona table
    $sql2 = "DELETE FROM persona WHERE Num_Doc='$num_doc'";
    
    if ($conn->query($sql2) === TRUE) {
        header("Location: lista-empleados.php");
    } else {
        echo "Error deleting record from persona: " . $conn->error;
    }
} else {
    echo "Error deleting record from empleado: " . $conn->error;
}
?>
