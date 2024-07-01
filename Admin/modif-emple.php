<?php
include('../includes/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $num_doc = $_POST['Num_Doc']; // Cambiado de 'num_doc' a 'Num_Doc' para que coincida con el formulario
    $tipo_doc = $_POST['tipo_doc'];
    $prim_nombre = $_POST['prim_nombre'];
    $seg_nombre = $_POST['seg_nombre'];
    $prim_apellido = $_POST['prim_apellido'];
    $seg_apellido = $_POST['seg_apellido'];
    $genero = $_POST['genero'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena']; // Añadido para obtener la contraseña
    $id_cargo = $_POST['id_cargo'];

    $sql = $sql = "UPDATE persona SET 
                        Tipo_Doc='$tipo_doc', 
                        Prim_Nombre='$prim_nombre', 
                        Seg_Nombre='$seg_nombre', 
                        Prim_Apellido='$prim_apellido', 
                        Seg_Apellido='$seg_apellido', 
                        Genero='$genero', 
                        Telefono='$telefono', 
                        Correo='$correo', 
                        Contrasena='$contrasena', 
                        Id_Cargo='$id_cargo' 
                    WHERE Num_Doc='$num_doc'";


    if ($conn->query($sql) === TRUE) {
        header("Location: lista-empleados.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    if (isset($_GET['num_doc'])) { // Cambiado de 'Num_Doc' a 'num_doc' para que coincida con la URL
        $num_doc = $_GET['num_doc']; // Cambiado de 'Num_Doc' a 'num_doc' para que coincida con la URL
        $sql = "SELECT * FROM persona WHERE Num_Doc='$num_doc'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Empleado</title>
    <link rel="stylesheet" href="../Assets/css/modif_emp.css">
    
</head>
<body>
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
        <h2>Modificar Empleado</h2>
        <form method="POST" action="">
        <input type="hidden" name="Num_Doc" value="<?php echo $num_doc; ?>">
            <div class="form-group">
                <label for="tipo_doc">Tipo de Documento:</label>
                <input type="text" id="tipo_doc" name="tipo_doc" value="<?php echo $row['Tipo_Doc']; ?>" required>
            </div>
            <div class="form-group">
    <label for="prim_nombre">Primer Nombre:</label>
    <input type="text" id="prim_nombre" name="prim_nombre" value="<?php echo $row['Prim_Nombre']; ?>" required>
</div>
<div class="form-group">
    <label for="seg_nombre">Segundo Nombre:</label>
    <input type="text" id="seg_nombre" name="seg_nombre" value="<?php echo $row['Seg_Nombre']; ?>">
</div>
<div class="form-group">
    <label for="prim_apellido">Primer Apellido:</label>
    <input type="text" id="prim_apellido" name="prim_apellido" value="<?php echo $row['Prim_Apellido']; ?>" required>
</div>
<div class="form-group">
    <label for="seg_apellido">Segundo Apellido:</label>
    <input type="text" id="seg_apellido" name="seg_apellido" value="<?php echo $row['Seg_Apellido']; ?>">
</div>
<div class="form-group">
    <label for="genero">Género:</label>
    <select id="genero" name="genero" required>
        <?php
        $sql_genero = "SELECT * FROM genero";
        $result_genero = $conn->query($sql_genero);
        if ($result_genero->num_rows > 0) {
            while ($row_genero = $result_genero->fetch_assoc()) {
                echo "<option value='" . $row_genero['Genero'] . "'";
                if ($row_genero['Genero'] == $row['Genero']) {
                    echo " selected";
                }
                echo ">" . $row_genero['Genero'] . "</option>";
            }
        } else {
            echo "<option value=''>No hay géneros disponibles</option>";
        }
        ?>
    </select>
</div>
<div class="form-group">
    <label for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" name="telefono" value="<?php echo $row['Telefono']; ?>" required>
</div>
<div class="form-group">
    <label for="correo">Correo Electrónico:</label>
    <input type="email" id="correo" name="correo" value="<?php echo $row['Correo']; ?>" required>
</div>
<div class="form-group">
    <label for="contrasena">Contraseña:</label> <!-- Cambiado el nombre del campo a 'contrasena' -->
    <input type="password" id="contrasena" name="contrasena" value="<?php echo $row['Contrasena']; ?>" required>
    
</div>
<div class="form-group">
    <label for="id_cargo">Cargo:</label>
    <select id="id_cargo" name="id_cargo" required>
    <?php
    $sql_cargo = "SELECT * FROM cargo";
    $result_cargo = $conn->query($sql_cargo);
    while($row_cargo = $result_cargo->fetch_assoc()) {
        echo "<option value='" . $row_cargo['Id_Cargo'] . "'>" . $row_cargo['Cargo'] . "</option>";
    }
    ?>
    </select>
    </select>
</div>
            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>
<?php
        } else {
            echo "No se encontró ningún registro con el número de documento proporcionado.";
        }
    } else {
        echo "El número de documento no fue proporcionado.";
    }
}
?>
