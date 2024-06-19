<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    // Guardar la orden en la sesión antes de redirigir a inicio de sesión
    $_SESSION['orden'] = [
        'total' => $_POST['total']
    ];
    // Redirigir al inicio de sesión
    header('Location: ../inicio sesion/iniciosesion.php');
    exit();
} else {
    // Redirigir al formulario de orden de compra
    header('Location: orden_compra.php');
    exit();
}
?>
