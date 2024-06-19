<?php
include("../includes/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre_producto = $_POST['nombre_producto'];
    $lote = $_POST['lote'];
    // Agrega los demás campos que deseas actualizar

    $sql = "UPDATE inventario SET Nom_Product = '$nombre_producto', Lote = '$lote' WHERE Id_FlujoInven = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado correctamente";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
