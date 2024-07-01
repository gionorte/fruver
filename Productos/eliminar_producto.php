<?php
include("../includes/conexion.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar las ventas asociadas al producto
    $sql_delete_ventas = "DELETE FROM ventas WHERE Id_Producto = $id";

    if ($conn->query($sql_delete_ventas) === TRUE) {
        // Ahora, eliminar las referencias en la tabla inventario
        $sql_delete_inventario = "DELETE FROM inventario WHERE Id_Producto = $id";

        if ($conn->query($sql_delete_inventario) === TRUE) {
            // Finalmente, eliminar el producto de la base de datos
            $sql_delete_producto = "DELETE FROM productos WHERE Id_Producto = $id";

            if ($conn->query($sql_delete_producto) === TRUE) {
                echo '<script>
                        alert("Se ha eliminado exitosamente");
                        window.location = "lista-produc.php"; 
                      </script>';
            } else {
                echo "Error al eliminar el producto: " . $conn->error;
            }
        } else {
            echo "Error al eliminar las referencias en la tabla inventario: " . $conn->error;
        }
    } else {
        echo "Error al eliminar las ventas asociadas al producto: " . $conn->error;
    }

    $conn->close();
} else {
    echo "ID de producto no especificado.";
}
?>
