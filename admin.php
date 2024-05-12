<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut</title>
    <link href="img/icono.png" rel="icon">
    <link rel="stylesheet" href="css/admin.css">
    <!-- Agregar enlace al icono de cerrar sesión -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Estilos para el botón de cerrar sesión */
        .logout-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="img/iconus.png" alt="icon">
        <br>
        <br>
        <h2>Erik Armando Pabon Tovar</h2>
        <br>
        <button class="btn" onclick="window.location.href='registrar_empleado.html'">Registrar Empleado</button>
        <button class="btn" onclick="window.location.href='registrar_producto.html'">Registrar Producto</button>
        <button class="btn" onclick="window.location.href='ver_orden_compra.html'">Ver Orden de Compra</button>
        <button class="btn" onclick="window.location.href='lista_productos.html'">Lista de Productos</button>
        <button class="btn" onclick="window.location.href='lista_empleados.html'">Lista de Empleados</button>
        <button class="btn" onclick="window.location.href='asignar_tarea.php'">Asignar Tarea</button>
        <!-- Botón de cerrar sesión -->
        <button class="logout-btn" onclick="window.location.href='index.php'">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </button>
    </div>
    <div class="main-content">
        <!-- Aquí puedes agregar más contenido HTML si es necesario -->
    </div>

    <!-- Script para cerrar sesión (debe ser implementado en tu backend) -->
    <script>
        function cerrarSesion() {
            // Aquí colocarías la lógica para cerrar la sesión del usuario
            // Por ejemplo, podrías hacer una solicitud al servidor para cerrar la sesión
            // y luego redirigir al usuario a la página de inicio de sesión o a otra página relevante.
            alert("¡Sesión cerrada!");
        }
    </script>
</body>
</html>
