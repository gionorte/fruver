<?php
session_start();
include("conexion.php");

function getClienteInfo($conn) {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT Num_Doc, Tipo_Doc, Prim_Nombre, Seg_Nombre, Prim_Apellido, Seg_Apellido, Genero, Telefono, Correo FROM clientes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return ['error' => 'No se encontraron datos'];
    }

    $stmt->close();
    $conn->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['error' => 'No has iniciado sesión']);
        exit();
    }
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
    <title>Consultar Cliente</title>
    <link rel="stylesheet" href="css/inter-in.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <h1 class="logo"><a href="inter-inicio.php"><img src="img/icono.png" alt="icon" style="width: 60px;"></a></h1>
            </div>
        </div>
        <div>
            <h2 class="eri">INZUFRUT</h2>
        </div>
    </header>
    <main>
        <h2>Consultar Información del Cliente</h2>
        <button onclick="getClienteInfo()">Consultar Información</button>
        <div id="cliente-info"></div>
    </main>
    <script>
        async function getClienteInfo() {
            try {
                const response = await fetch('', {
                    method: 'POST'
                });
                const result = await response.json();
                if (result.error) {
                    alert('Error: ' + result.error);
                } else {
                    displayClienteInfo(result);
                }
            } catch (error) {
                console.error('Error fetching client info:', error);
            }
        }

        function displayClienteInfo(info) {
            const infoDiv = document.getElementById('cliente-info');
            infoDiv.innerHTML = `
                <p><strong>Documento:</strong> ${info.Num_Doc}</p>
                <p><strong>Tipo de Documento:</strong> ${info.Tipo_Doc}</p>
                <p><strong>Primer Nombre:</strong> ${info.Prim_Nombre}</p>
                <p><strong>Segundo Nombre:</strong> ${info.Seg_Nombre}</p>
                <p><strong>Primer Apellido:</strong> ${info.Prim_Apellido}</p>
                <p><strong>Segundo Apellido:</strong> ${info.Seg_Apellido}</p>
                <p><strong>Género:</strong> ${info.Genero}</p>
                <p><strong>Teléfono:</strong> ${info.Telefono}</p>
                <p><strong>Correo:</strong> ${info.Correo}</p>
            `;
        }
    </script>
</body>
</html>