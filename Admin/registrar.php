
<?php
session_start();
if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../inicio sesion/iniciosesion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut - Registro</title>
    <link rel="stylesheet" href="../Assets/css/regis_per.css">
    <link href="img/icono.png" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .error-message {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>

<body>
    <main id="hero">
        <div class="capa"></div>
        <header>
            <div class="logo">
                <h1><a href="admin.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a></h1>
            </div>
        </header>
        <div class="form-container inicio">
            <h2>Registro de Persona</h2>
            <div id="notificacion" style="display: none;">Registro exitoso</div>
            <form action="procesar_regis.php" method="post">
                <div class="form-group">
                    <label for="num_doc">Número de Documento: *</label>
                    <input type="text" id="num_doc" name="num_doc" placeholder="Ingrese su número de documento">
                    <div id="num_doc_error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="tipo_doc">Tipo de Documento: *</label>
                    <select id="tipo_doc" name="tipo_doc">
                        <option value="" disabled selected hidden>Seleccione el tipo de documento</option>
                        <?php
                        include("../includes/conexion.php");
                        $sql_tipo_documento = "SELECT * FROM tipo_documento";
                        $result_tipo_documento = $conn->query($sql_tipo_documento);
                        while ($row_tipo_doc = $result_tipo_documento->fetch_assoc()) {
                            echo "<option value='" . $row_tipo_doc['Tipo_Doc'] . "'>" . $row_tipo_doc['Tipo_Doc'] . "</option>";
                        }
                        ?>
                    </select>
                    <div id="tipo_doc_error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="prim_nombre">Primer Nombre: *</label>
                    <input type="text" id="prim_nombre" name="prim_nombre" placeholder="Ingrese su primer nombre">
                    <div id="prim_nombre_error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="seg_nombre">Segundo Nombre:</label>
                    <input type="text" id="seg_nombre" name="seg_nombre" placeholder="Ingrese su segundo nombre">
                </div>
                <div class="form-group">
                    <label for="prim_apellido">Primer Apellido: *</label>
                    <input type="text" id="prim_apellido" name="prim_apellido" placeholder="Ingrese su primer apellido">
                    <div id="prim_apellido_error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="seg_apellido">Segundo Apellido:</label>
                    <input type="text" id="seg_apellido" name="seg_apellido" placeholder="Ingrese su segundo apellido">
                </div>
                <div class="form-group">
                    <label for="genero">Género:</label>
                    <select id="genero" name="genero">
                        <?php
                        $sql_genero = "SELECT * FROM genero";
                        $result_genero = $conn->query($sql_genero);
                        while ($row_genero = $result_genero->fetch_assoc()) {
                            echo "<option value='" . $row_genero['Genero'] . "'>" . $row_genero['Genero'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono: *</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="Ingrese su número de teléfono">
                    <div id="telefono_error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="correo">Correo Electrónico: *</label>
                    <input type="email" id="correo" name="correo" placeholder="Ingrese su correo electrónico">
                    <div id="correo_error" class="error-message"></div>
                </div>
                <div class="form-group password-container">
                    <label for="contrasena">Contraseña: *</label>
                    <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña">
                    <i class="fa fa-eye eye-icon" id="eye-icon" onclick="togglePassword()"></i>
                    <div id="contrasena_error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="salario">Salario: *</label>
                    <input type="number" id="salario" name="salario" step="0.01" placeholder="Ingrese su salario">
                    <div id="salario_error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="id_cargo">Cargo: *</label>
                    <select id="id_cargo" name="id_cargo">
                        <option value="" selected disabled>Seleccione un cargo</option>
                        <?php
                        $sql_cargo = "SELECT * FROM cargo";
                        $result_cargo = $conn->query($sql_cargo);
                        while ($row_cargo = $result_cargo->fetch_assoc()) {
                            echo "<option value='" . $row_cargo['Id_Cargo'] . "'>" . $row_cargo['Cargo'] . "</option>";
                        }
                        ?>
                    </select>
                    <div id="id_cargo_error" class="error-message"></div>
                </div>
                <input type="submit" value="Registrar">
            </form>
        </div>
    </main>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById('contrasena');
            var eyeIcon = document.getElementById('eye-icon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
    <script src="../Assets/js/registro_exitoso.js"></script>
    <script src="../Assets/js/validacion_regis_per.js"></script>
    
</body>

</html>
