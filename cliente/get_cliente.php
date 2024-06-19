<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

session_start();
include("../includes/conexion.php");

function getClienteInfo($conn) {
    if (!isset($_SESSION['user_id'])) {
        return ['error' => 'No has iniciado sesión'];
    }

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT Num_Doc, Tipo_Doc, Prim_Nombre, Seg_Nombre, Prim_Apellido, Seg_Apellido, Genero, Telefono, Correo FROM clientes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        return ['error' => 'Error en la preparación de la consulta'];
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $clienteInfo = $result->fetch_assoc();
    } else {
        $clienteInfo = ['error' => 'No se encontraron datos'];
    }

    $stmt->close();
    $conn->close();

    var_dump($clienteInfo); // Verificar qué datos se están recuperando

    return $clienteInfo;
    

} 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $response = getClienteInfo($conn);
    echo json_encode($response);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="profile-data"></div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="cliente/get_cliente.php"></script>


</body>
<script>
    
    async function fetchProfileData() {
            try {
                const response = await fetch('clinete/get_cliente.php');
                const data = await response.json();
                if (data.error) {
                    document.getElementById('profile-data').innerHTML = `<p>${data.error}</p>`;
                } else {
                    document.getElementById('profile-data').innerHTML = `
                        <p><strong>Número de Documento:</strong> ${data.Num_Doc}</p>
                        <p><strong>Tipo de Documento:</strong> ${data.Tipo_Doc}</p>
                        <p><strong>Primer Nombre:</strong> ${data.Prim_Nombre}</p>
                        <p><strong>Segundo Nombre:</strong> ${data.Seg_Nombre}</p>
                        <p><strong>Primer Apellido:</strong> ${data.Prim_Apellido}</p>
                        <p><strong>Segundo Apellido:</strong> ${data.Seg_Apellido}</p>
                        <p><strong>Género:</strong> ${data.Genero}</p>
                        <p><strong>Teléfono:</strong> ${data.Telefono}</p>
                        <p><strong>Correo:</strong> ${data.Correo}</p>
                    `;
                }
            } catch (error) {
                console.error('Error fetching profile data:', error);
            }
        }

        fetchProfileData();
</script>
</html>
