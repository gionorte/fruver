<?php
session_start();
if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: iniciosesion.php");
    exit();
}

include("conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta SQL para eliminar el producto
    $sql = "DELETE FROM productos WHERE Id_Producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirige de nuevo a la página de gestión de productos con un mensaje de éxito
        header("Location: lista-produc.php?mensaje=Producto eliminado correctamente");
    } else {
        // Redirige de nuevo a la página de gestión de productos con un mensaje de error
        header("Location: lista-produc.php?mensaje=Error al eliminar el producto");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: lista-produc.php?mensaje=ID de producto no especificado");
    exit();
}
?>
