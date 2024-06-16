<?php
session_start();
include("conexion.php");

function updateClienteInfo($conn) {
    $user_id = $_SESSION['user_id'];

    // Verificar si los campos obligatorios están presentes
    $required_fields = ['Prim_Nombre', 'Prim_Apellido', 'Telefono', 'Correo'];
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field])) {
            return ['success' => false, 'message' => 'Campo faltante: ' . $field];
        }
    }

    $prim_nombre = $_POST['Prim_Nombre'];
    $seg_nombre = isset($_POST['Seg_Nombre']) ? $_POST['Seg_Nombre'] : null;
    $prim_apellido = $_POST['Prim_Apellido'];
    $seg_apellido = isset($_POST['Seg_Apellido']) ? $_POST['Seg_Apellido'] : null;
    $telefono = $_POST['Telefono'];
    $correo = $_POST['Correo'];

    $sql = "UPDATE clientes SET Prim_Nombre = ?, Seg_Nombre = ?, Prim_Apellido = ?, Seg_Apellido = ?, Telefono = ?, Correo = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $prim_nombre, $seg_nombre, $prim_apellido, $seg_apellido, $telefono, $correo, $user_id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return ['success' => true];
    } else {
        $stmt->close();
        $conn->close();
        return ['success' => false, 'message' => 'Error al actualizar el perfil'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'No has iniciado sesión']);
        exit();
    }
    $response = updateClienteInfo($conn);
    echo json_encode($response);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cliente</title>
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
        <h2>Actualizar Información del Cliente</h2>
        <form id="update-form">
            <label for="Prim_Nombre">Primer Nombre:</label>
            <input type="text" id="Prim_Nombre" name="Prim_Nombre" required>
            <br>
            <label for="Seg_Nombre">Segundo Nombre:</label>
            <input type="text" id="Seg_Nombre" name="Seg_Nombre">
            <br>
            <label for="Prim_Apellido">Primer Apellido:</label>
            <input type="text" id="Prim_Apellido" name="Prim_Apellido" required>
            <br>
            <label for="Seg_Apellido">Segundo Apellido:</label>
            <input type="text" id="Seg_Apellido" name="Seg_Apellido">
            <br>
            <label for="Telefono">Teléfono:</label>
            <input type="text" id="Telefono" name="Telefono" required>
            <br>
            <label for="Correo">Correo:</label>
            <input type="email" id="Correo" name="Correo" required>
            <br>
            <button type="button" onclick="updateProfile()">Actualizar Perfil</button>
        </form>
    </main>
    <script>
        async function updateProfile() {
            const form = document.getElementById('update-form');
            const formData = new FormData(form);

            try {
                const response = await fetch('', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();
                if (result.success) {
                    alert('Perfil actualizado exitosamente');
                } else {
                    alert('Error al actualizar el perfil: ' + result.message);
                }
            } catch (error) {
                console.error('Error updating profile:', error);
            }
        }
    </script>
</body>
</html>
