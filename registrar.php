<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut - Registro</title>
    <link rel="stylesheet" href="css/regis.css">
    <link href="img/icono.png" rel="icon">
    <script>
        // Función para mostrar la notificación
        function mostrarNotificacion() {
            var notificacion = document.getElementById('notificacion');
            notificacion.style.display = 'block';
            setTimeout(function(){
                notificacion.style.display = 'none';
            }, 3000); // La notificación se ocultará automáticamente después de 3 segundos (3000 milisegundos)
        }
    </script>
</head>
<body>

    <h2>Registro de Persona</h2>
    <div id="notificacion" style="display: none;">Registro exitoso</div>
    <form action="procesar_regis.php" method="post">
        <label for="num_doc">Número de Documento:</label><br>
        <input type="text" id="num_doc" name="num_doc" required><br>
        
        <label for="tipo_doc">Tipo de Documento:</label><br>
        <select id="tipo_doc" name="tipo_doc" required>
            <?php

            // Consulta SQL para obtener los tipos de documento
            $sql_tipo_documento = "SELECT * FROM tipo_documento";
            $result_tipo_documento = $conn->query($sql_tipo_documento);

            // Mostrar opciones de tipo de documento
            while($row_tipo_doc = $result_tipo_documento->fetch_assoc()) {
                echo "<option value='" . $row_tipo_doc['Tipo_Doc'] . "'>" . $row_tipo_doc['Tipo_Doc'] . "</option>";
            }
            ?>
        </select><br>
        
        <label for="prim_nombre">Primer Nombre:</label><br>
        <input type="text" id="prim_nombre" name="prim_nombre" required><br>
        
        <label for="seg_nombre">Segundo Nombre:</label><br>
        <input type="text" id="seg_nombre" name="seg_nombre"><br>
        
        <label for="prim_apellido">Primer Apellido:</label><br>
        <input type="text" id="prim_apellido" name="prim_apellido" required><br>
        
        <label for="seg_apellido">Segundo Apellido:</label><br>
        <input type="text" id="seg_apellido" name="seg_apellido"><br>
        
        <label for="genero">Género:</label><br>
        <select id="genero" name="genero" required>
            <?php
            // Consulta SQL para obtener los géneros
            $sql_genero = "SELECT * FROM genero";
            $result_genero = $conn->query($sql_genero);

            // Mostrar opciones de género
            while($row_genero = $result_genero->fetch_assoc()) {
                echo "<option value='" . $row_genero['Genero'] . "'>" . $row_genero['Genero'] . "</option>";
            }
            ?>
        </select><br>
        
        <label for="telefono">Teléfono:</label><br>
        <input type="tel" id="telefono" name="telefono" required><br>
        
        <label for="correo">Correo Electrónico:</label><br>
        <input type="email" id="correo" name="correo" required><br>
        
        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="contrasena" required><br>
        
        <label for="id_cargo">Cargo:</label><br>
        <select id="id_cargo" name="id_cargo" required>
            <?php
            // Consulta SQL para obtener los cargos
            $sql_cargo = "SELECT * FROM cargo";
            $result_cargo = $conn->query($sql_cargo);

            // Mostrar opciones de cargo
            while($row_cargo = $result_cargo->fetch_assoc()) {
                echo "<option value='" . $row_cargo['Id_Cargo'] . "'>" . $row_cargo['Cargo'] . "</option>";
            }
            ?>
        </select><br>
        
        <input type="submit" value="Registrar">
    </form>
</body>
</html>
