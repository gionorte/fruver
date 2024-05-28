<?php
include('conexion.php');

$num_doc = $_GET['num_doc'];
$sql = "DELETE FROM persona WHERE Num_Doc='$num_doc'";

if ($conn->query($sql) === TRUE) {
    header("Location: lista-empleados.php");
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
