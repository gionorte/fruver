<?php
session_start();
if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../inicio_sesion/iniciosesion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Tarea</title>
    <link href="../Assets/img/icono.png" rel="icon">
    <link rel="stylesheet" href="../Assets/css/asignar-tar.css">
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
        <h1>
            <?php

            if (isset($_SESSION['Id_Cargo'])) {
                if ($_SESSION['Id_Cargo'] == 1) {
                    // Si es administrador, regresar a la página de administrador
                    echo '<a href="../Admin/admin.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a>';
                } elseif ($_SESSION['Id_Cargo'] == 2) {
                    // Si es empleado, regresar a la página de empleado
                    echo '<a href="../Admin/empleado.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a>';
                }
            } else {
                // Si no hay sesión, redirigir a la página de inicio de sesión
                echo '<a href="../inicio sesion/iniciosesion.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a>';
            }
            ?>
        </h1>
    </div>
</header>
        <div class="form-container">
            <h1>Formulario para Asignar Tarea</h1>
            <form action="procesar_asignacion.php" method="post" onsubmit="return validarFormulario()">
                <div class="form-group">
                    <label for="num_doc">Número de Documento: *</label>
                    <select id="num_doc" name="num_doc" >
                        <?php
                        include("../includes/conexion.php");
                        $sql_Num_Doc = "SELECT Num_Doc FROM persona";
                        $result_Num_Doc = $conn->query($sql_Num_Doc);
                        while ($row_Num_Doc = $result_Num_Doc->fetch_assoc()) {
                            echo "<option value='" . $row_Num_Doc['Num_Doc'] . "'>" . $row_Num_Doc['Num_Doc'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="actividad">Actividad: *</label>
                    <input type="text" id="actividad" name="actividad" placeholder="Ingrese la actividad">
                    <div id="actividad_error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción: *</label>
                    <textarea id="descripcion" name="descripcion" placeholder="Ingrese la descripción"></textarea>
                    <div id="descripcion_error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de Inicio: *</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" placeholder="Seleccione fecha de inicio">
                    <div id="fecha_inicio_error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="fecha_fin">Fecha de Fin: *</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" placeholder="Seleccione fecha de fin">
                    <div id="fecha_fin_error" class="error-message"></div>
                </div>
                <input type="submit" value="Asignar Tarea">
            </form>
        </div>
    </main>
    <script>
    function validarFormulario() {
        let isValid = true;

        // Resetear mensajes de error
        document.querySelectorAll('.error-message').forEach(function (el) {
            el.textContent = '';
        });

        // Validar cada campo
        const actividad = document.getElementById('actividad');
        const descripcion = document.getElementById('descripcion');
        const fechaInicio = document.getElementById('fecha_inicio');
        const fechaFin = document.getElementById('fecha_fin');

        if (actividad.value.trim() === '') {
            mostrarError('actividad', 'Por favor, ingrese la actividad.');
            isValid = false;
        }

        if (descripcion.value.trim() === '') {
            mostrarError('descripcion', 'Por favor, ingrese la descripción.');
            isValid = false;
        }

        if (fechaInicio.value === '') {
            mostrarError('fecha_inicio', 'Por favor, seleccione la fecha de inicio.');
            isValid = false;
        }

        if (fechaFin.value === '') {
            mostrarError('fecha_fin', 'Por favor, seleccione la fecha de fin.');
            isValid = false;
        }

        return isValid;
    }

    function mostrarError(idCampo, mensaje) {
        const campo = document.getElementById(idCampo);
        const errorCampo = campo.nextElementSibling;
        errorCampo.textContent = mensaje;
    }
</script>

</body>
</html>
