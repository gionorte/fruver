<?php
session_start();
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $total = $_POST['total'];

    // Aquí se enviarán los datos a la API de PSE
    // Ejemplo genérico de llamada a API (debes adaptarlo según el proveedor)
    $url = "https://api.pse.com/transaction";
    $data = array(
        "nombre" => $nombre,
        "email" => $email,
        "telefono" => $telefono,
        "total" => $total,
        "descripcion" => "Compra en línea",
        // Otros parámetros necesarios
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        // Manejar error
        echo "Error en el pago. Por favor, inténtelo de nuevo.";
    } else {
        // Procesar la respuesta y redirigir al entorno seguro de PSE
        $response = json_decode($result, true);
        if ($response['status'] == 'success') {
            header('Location: ' . $response['pse_url']);
            exit();
        } else {
            echo "Error en el pago: " . $response['message'];
        }
    }
} else {
    echo "Método de solicitud no válido.";
}
?>
