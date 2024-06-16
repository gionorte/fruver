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
    <title>Registrar Producto - Inzufrut</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="img/icono.png" rel="icon">
    <link rel="stylesheet" href="../Assets/css/producto.css">
</head>

<body>
    <main id="hero">
        <header>
            <div class="logo">
                <h1 class="logo"><a href="../Admin/admin.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a></h1>
            </div>
        </header>

        <div class="form-container inicio">
            <h2>Registrar Producto</h2>
            <form action="procesar_producto.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nom_product">Nombre del Producto: *</label>
                    <input type="text" id="nom_product" name="nom_product">
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad: *</label>
                    <input type="number" id="cantidad" name="cantidad">
                </div>
                <div class="form-group">
                    <label for="fecha_venc">Fecha de Vencimiento: *</label>
                    <input type="date" id="fecha_venc" name="fecha_venc">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción: *</label>
                    <textarea id="descripcion" name="descripcion"></textarea>
                </div>
                <div class="form-group">
                    <label for="id_estado">Estado: *</label>
                    <select id="id_estado" name="id_estado" required>
                        <?php
                        include("../includes/conexion.php");
                        $sql_estado = "SELECT * FROM estado";
                        $result_estado = $conn->query($sql_estado);
                        while ($row_estado = $result_estado->fetch_assoc()) {
                            echo "<option value='" . $row_estado['Estado'] . "'>" . $row_estado['Estado'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="precio">Precio: *</label>
                    <input type="number" step="0.01" id="precio" name="precio">
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen del Producto: *</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*">
                </div>
                <input type="submit" value="Registrar">
            </form>
        </div>
    </main>
    <script src="js/validaciones_producto.js"></script>
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