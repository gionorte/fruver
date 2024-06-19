<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut - Registro</title>
    <link rel="stylesheet" href="../Assets/css/regis_per.css">
    <link href="../Assets/img/icono.png" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .error-message {
            color: red;
            font-size: 0.8em;
        }
    </style>
</head>
<body>
    <main id="hero">
        <div class="capa"></div>
        <header>
            <div class="logo">
                <h1><a href="../inter-inicio.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a></h1>
            </div>
        </header>
        <div class="form-container inicio">
            <h2>Registro de Cliente</h2>
            <div id="notificacion" style="display: none;">Registro exitoso</div>
            <form id="registroForm" action="procesar_regis_clien.php" method="post" onsubmit="return validarFormulario()">
                <div class="form-group">
                    <label for="num_doc">Número de Documento: *</label>
                    <input type="text" id="num_doc" name="num_doc" placeholder="Ingrese su número de documento">
                    <div id="errorNumDoc" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="tipo_doc">Tipo de Documento: *</label>
                    <select id="tipo_doc" name="tipo_doc">
                        <option value="" disabled selected hidden>Seleccione el tipo de documento</option>
                        <?php
                        include("../includes/conexion.php");
                        $sql_tipo_documento = "SELECT * FROM tipo_documento";
                        $result_tipo_documento = $conn->query($sql_tipo_documento);
                        while($row_tipo_doc = $result_tipo_documento->fetch_assoc()) {
                            echo "<option value='" . $row_tipo_doc['Tipo_Doc'] . "'>" . $row_tipo_doc['Tipo_Doc'] . "</option>";
                        }
                        ?>
                    </select>
                    <div id="errorTipoDoc" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="prim_nombre">Primer Nombre: *</label>
                    <input type="text" id="prim_nombre" name="prim_nombre" placeholder="Ingrese su primer nombre">
                    <div id="errorPrimNombre" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="seg_nombre">Segundo Nombre:</label>
                    <input type="text" id="seg_nombre" name="seg_nombre" placeholder="Ingrese su segundo nombre si lo tiene">
                </div>
                <div class="form-group">
                    <label for="prim_apellido">Primer Apellido: *</label>
                    <input type="text" id="prim_apellido" name="prim_apellido" placeholder="Ingrese su primer apellido">
                    <div id="errorPrimApellido" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="seg_apellido">Segundo Apellido:</label>
                    <input type="text" id="seg_apellido" name="seg_apellido" placeholder="Ingrese su segundo apellido si lo tiene">
                </div>
                <div class="form-group">
                    <label for="genero">Género:</label>
                    <select id="genero" name="genero">
                        <option value="" disabled selected hidden>Seleccione su género</option>
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
                    <input type="tel" id="telefono" name="telefono" placeholder="Ingrese su número de teléfono">
                    <div id="errorTelefono" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="correo">Correo Electrónico: *</label>
                    <input type="email" id="correo" name="correo" placeholder="Ingrese su correo electrónico">
                    <div id="errorCorreo" class="error-message"></div>
                </div>
                <div class="form-group password-container">
                    <label for="contrasena">Contraseña: *</label>
                    <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña">
                    <i class="fa fa-eye eye-icon" id="eye-icon" onclick="togglePassword()"></i>
                    <div id="errorContrasena" class="error-message"></div>
                </div>
                <!-- Campo oculto para el id_cargo -->
                <input type="hidden" id="id_cargo" name="id_cargo" value="3">
                <input type="submit" value="Registrar">
            </form>
            <br>
            <button onclick="window.location.href='../inter-inicio.php'" class="btn-volver">Volver</button>
        </div>
        <div id="successMessage" class="success-message"></div>
    </main>
    <script>
        function validarFormulario() {
            let isValid = true;

            // Resetear mensajes de error
            document.querySelectorAll('.error-message').forEach(function (el) {
                el.textContent = '';
            });            

            document.getElementById('successMessage').textContent = '';

            // Validar cada campo
            const numDoc = document.getElementById('num_doc');
            const tipoDoc = document.getElementById('tipo_doc');
            const primNombre = document.getElementById('prim_nombre');
            const primApellido = document.getElementById('prim_apellido');
            const telefono = document.getElementById('telefono');
            const correo = document.getElementById('correo');
            const contrasena = document.getElementById('contrasena');

            if (numDoc.value.trim() === '') {
                document.getElementById('errorNumDoc').textContent = 'Ingrese su número de documento.';
                isValid = false;
            }

            if (tipoDoc.value === '') {
                document.getElementById('errorTipoDoc').textContent = 'Seleccione el tipo de documento.';
                isValid = false;
            }

            if (primNombre.value.trim() === '') {
                document.getElementById('errorPrimNombre').textContent = 'Ingrese su primer nombre.';
                isValid = false;
            }

            if (primApellido.value.trim() === '') {
                document.getElementById('errorPrimApellido').textContent = 'Ingrese su primer apellido.';
                isValid = false;
            }

            if (telefono.value.trim() === '') {
                document.getElementById('errorTelefono').textContent = 'Ingrese su número de teléfono.';
                isValid = false;
            }

            if (correo.value.trim() === '') {
                document.getElementById('errorCorreo').textContent = 'Ingrese su correo electrónico.';
                isValid = false;
            }

            if (contrasena.value.trim() === '') {
                document.getElementById('errorContrasena').textContent = 'Ingrese su contraseña.';
                isValid = false;
            }

            if (isValid) {
                document.getElementById('successMessage').textContent = 'El cliente ha sido registrado exitosamente.';
                document.getElementById('successMessage').style.display = 'block';
            }           

            return isValid;
        }

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
</body>
</html>
