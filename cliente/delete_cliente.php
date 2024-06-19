<?php
session_start();
include("../includes/conexion.php");

function handleDeleteRequest($conn) {
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM clientes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        session_destroy();
        return ['success' => true];
    } else {
        $stmt->close();
        $conn->close();
        return ['success' => false, 'message' => 'Error al eliminar el perfil'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'No has iniciado sesión']);
        exit();
    }
    $response = handleDeleteRequest($conn);
    echo json_encode($response);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cliente</title>
    <link rel="stylesheet" href="css/inter-in.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <h1 class="logo"><a href="../inter-inicio.php"><img src="../Assets/img/icono.png" alt="icon" style="width: 60px;"></a></h1>
            </div>
        </div>
        <div>
            <h2 class="eri">INZUFRUT</h2>
        </div>
    </header>
    <main>
        <h2>Eliminar Perfil</h2>
        <button onclick="deleteProfile()">Eliminar Perfil</button>
    </main>
    <script>
        async function deleteProfile() {
            if (confirm('¿Estás seguro de que deseas eliminar tu perfil?')) {
                try {
                    const response = await fetch('', {
                        method: 'POST'
                    });
                    const result = await response.json();
                    if (result.success) {
                        alert('Perfil eliminado exitosamente');
                        window.location.href = 'inter-inicio.php';
                    } else {
                        alert('Error al eliminar el perfil: ' + result.message);
                    }
                } catch (error) {
                    console.error('Error deleting profile:', error);
                }
            }
        }
    </script>
</body>
</html>