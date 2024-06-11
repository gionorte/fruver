<?php
// Ejemplo de archivo `notificacion_pse.php`
session_start();
include '../conexion.php';

// Este archivo sería llamado por la pasarela PSE con el estado del pago

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibiendo datos de la pasarela PSE
    $transaction_id = $_POST['transaction_id'];
    $status = $_POST['status'];

    // Actualizar el estado de la orden en la base de datos
    $sql = "UPDATE ordenes SET estado = ? WHERE transaction_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $status, $transaction_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        if ($status == 'success') {
            // Vaciar el carrito si el pago fue exitoso
            unset($_SESSION['carrito']);
            echo "Pago exitoso. Gracias por tu compra.";
        } else {
            echo "El pago no se pudo procesar. Por favor, ponte en contacto con nosotros para más detalles.";
        }
    } else {
        echo "No se encontró ninguna transacción correspondiente al ID proporcionado.";
    }

    $stmt->close();
} else {
    echo "Método de solicitud no válido.";
}

$conn->close();
?>
