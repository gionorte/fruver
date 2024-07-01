<?php
session_start();
include '../includes/conexion.php';

if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: iniciosesion.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idVenta = isset($_POST['id_venta']) ? $_POST['id_venta'] : null;

    if (!$idVenta || !isset($_FILES['comprobante'])) {
        header("Location: carrito.php");
        exit();
    }

    // Subir el archivo del comprobante
    $targetDir = "comprobantes/";
    $fileName = basename($_FILES["comprobante"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES["comprobante"]["tmp_name"], $targetFilePath)) {
        // Guardar la ruta del archivo en la base de datos
        $sql = "UPDATE venta SET comprobante_pago = ?, En_Proceso = 0, Finalizadas = 1 WHERE Id_Venta = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $targetFilePath, $idVenta);
        $stmt->execute();
        $stmt->close();
        
        // Redirigir a una página de confirmación
        header("Location: confirmacion.php");
        exit();
    } else {
        echo "Hubo un error subiendo el archivo.";
    }
}
?>
