<?php
session_start();
if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../inicio sesion/iniciosesion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Tarea</title>
    <link rel="stylesheet" href="css/asignar-tar.css">
</head>
<body>
    <main id="hero">
        <div class="capa"></div>
        <header>
            <div class="logo">
                <h1><a href="admin.php"><img src="img/icono.png" alt="icono" style="width: 70px;"></a></h1>
            </div>
        </header>
        <div class="form-container">
            <h1>Formulario para Asignar Tarea</h1>
            <form action="procesar_asignacion.php" method="post">
                <div class="form-group">
                    <label for="num_doc">Número de Documento: *</label>
                    <select id="num_doc" name="num_doc" required>
                        <?php
                        include("conexion.php");
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
                    <input type="text" id="actividad" name="actividad" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción: *</label>
                    <textarea id="descripcion" name="descripcion" required></textarea>
                </div>
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de Inicio: *</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" required>
                </div>
                <div class="form-group">
                    <label for="fecha_fin">Fecha de Fin: *</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" required>
                </div>
                <input type="submit" value="Asignar Tarea">
            </form>
        </div>
    </main>
</body>
</html>
