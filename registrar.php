<?php
session_start();
if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: iniciosesion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut - Registro</title>
    <link rel="stylesheet" href="css/regis_per.css">
    <link href="img/icono.png" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <main id="hero">
        <div class="capa"></div>
        <header>
            <div class="logo">
                <h1><a href="admin.php"><img src="img/icono.png" alt="icono" style="width: 70px;"></a></h1>
            </div>
        </header>
        <div class="form-container inicio">
            <h2>Registro de Persona</h2>
            <div id="notificacion" style="display: none;">Registro exitoso</div>
            <form action="procesar_regis.php" method="post">
                <div class="form-group">
                    <label for="num_doc">Número de Documento: *</label>
                    <input type="text" id="num_doc" name="num_doc" >
                </div>
                <div class="form-group">
                    <label for="tipo_doc">Tipo de Documento: *</label>
                    <select id="tipo_doc" name="tipo_doc" >
                        <?php
                        include("conexion.php");
                        $sql_tipo_documento = "SELECT * FROM tipo_documento";
                        $result_tipo_documento = $conn->query($sql_tipo_documento);
                        while($row_tipo_doc = $result_tipo_documento->fetch_assoc()) {
                            echo "<option value='" . $row_tipo_doc['Tipo_Doc'] . "'>" . $row_tipo_doc['Tipo_Doc'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="prim_nombre">Primer Nombre: *</label>
                    <input type="text" id="prim_nombre" name="prim_nombre" >
                </div>
                <div class="form-group">
                    <label for="seg_nombre">Segundo Nombre:</label>
                    <input type="text" id="seg_nombre" name="seg_nombre">
                </div>
                <div class="form-group">
                    <label for="prim_apellido">Primer Apellido: *</label>
                    <input type="text" id="prim_apellido" name="prim_apellido" >
                </div>
                <div class="form-group">
                    <label for="seg_apellido">Segundo Apellido:</label>
                    <input type="text" id="seg_apellido" name="seg_apellido">
                </div>
                <div class="form-group">
                    <label for="genero">Género:</label>
                    <select id="genero" name="genero" >
                        <?php
                        $sql_genero = "SELECT * FROM genero";
                        $result_genero = $conn->query($sql_genero);
                        while($row_genero = $result_genero->fetch_assoc()) {
                            echo "<option value='" . $row_genero['Genero'] . "'>" . $row_genero['Genero'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono: *</label>
                    <input type="tel" id="telefono" name="telefono" >
                </div>
                <div class="form-group">
                    <label for="correo">Correo Electrónico: *</label>
                    <input type="email" id="correo" name="correo" >
                </div>
                <div class="form-group password-container">
                    <label for="contrasena">Contraseña: *</label>
                    <input type="password" id="contrasena" name="contrasena" >
                    <i class="fa fa-eye eye-icon" id="eye-icon"></i>
                </div>
                <div class="form-group">
                    <label for="id_cargo">Cargo: *</label>
                    <select id="id_cargo" name="id_cargo" required>
                        <?php
                        $sql_cargo = "SELECT * FROM cargo";
                        $result_cargo = $conn->query($sql_cargo);
                        while($row_cargo = $result_cargo->fetch_assoc()) {
                            echo "<option value='" . $row_cargo['Id_Cargo'] . "'>" . $row_cargo['Cargo'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <input type="submit" value="Registrar">
            </form>
        </div>
    </main>
    <script src="js/validacion-res-per.js"></script>
    <script>
        // Evitar que el usuario navegue hacia atrás
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        window.onpopstate = function() {
            window.history.go(1);
        };
    </script>
</body>
</html>
