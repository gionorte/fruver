<?php
include("../includes/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_empleado = $_POST['id_empleado'];
    $nom_product = $_POST['nom_product'];
    $lote = $_POST['lote'];
    $id_producto = $_POST['id_producto'];
    $id_venta = $_POST['id_venta'];

    // Check if the provided lote exists in the lote table using prepared statements
    $stmt = $conn->prepare("SELECT * FROM lote WHERE Lote = ?");
    $stmt->bind_param("s", $lote);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // The lote exists, proceed with the insert
        $stmt = $conn->prepare("INSERT INTO inventario (id_empleado, nom_product, lote, id_producto, id_venta) 
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $id_empleado, $nom_product, $lote, $id_producto, $id_venta);

        if ($stmt->execute()) {
            echo "Registro guardado exitosamente";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: Lote no existe en la tabla lote.";
    }

    $stmt->close();
    $conn->close();
}
?>
