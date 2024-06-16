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
    <title>Registrar Producto - Inzufrut</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="img/icono.png" rel="icon">
    <link rel="stylesheet" href="../Assets/css/producto.css">
    <style>
        .error-message {
            color: red;
            font-size: 0.9em;
        }
    </style>
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
            <form action="procesar_producto.php" method="post" enctype="multipart/form-data" id="registro_producto" onsubmit="return validarProducto()">
                <div class="form-group">
                    <label for="nom_product">Nombre del Producto: *</label>
                    <input type="text" id="nom_product" name="nom_product">
                    <div id="nom_product_error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad: *</label>
                    <input type="number" id="cantidad" name="cantidad">
                    <div id="cantidad_error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="fecha_venc">Fecha de Vencimiento: *</label>
                    <input type="date" id="fecha_venc" name="fecha_venc">
                    <div id="fecha_venc_error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción: *</label>
                    <textarea id="descripcion" name="descripcion"></textarea>
                    <div id="descripcion_error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="id_estado">Estado: *</label>
                    <select id="id_estado" name="id_estado">
                        <option value="" disabled selected hidden>Seleccione el estado</option>
                        <?php
                        include("../includes/conexion.php");
                        $sql_estado = "SELECT * FROM estado";
                        $result_estado = $conn->query($sql_estado);
                        while ($row_estado = $result_estado->fetch_assoc()) {
                            echo "<option value='" . $row_estado['Id_Estado'] . "'>" . $row_estado['Estado'] . "</option>";
                        }
                        ?>
                    </select>
                    <div id="id_estado_error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="precio">Precio: *</label>
                    <input type="number" step="0.01" id="precio" name="precio">
                    <div id="precio_error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen del Producto: *</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*">
                    <div id="imagen_error" class="error-message"></div>
                </div>
                <input type="submit" value="Registrar">
            </form>
        </div>
    </main>
 
    <script>
        function validarProducto() {
            let isValid = true;

            // Resetear mensajes de error
            document.querySelectorAll('.error-message').forEach(function (el) {
                el.textContent = '';
            });

            // Validar cada campo
            const nomProduct = document.getElementById('nom_product');
            const cantidad = document.getElementById('cantidad');
            const fechaVenc = document.getElementById('fecha_venc');
            const descripcion = document.getElementById('descripcion');
            const idEstado = document.getElementById('id_estado');
            const precio = document.getElementById('precio');
            const imagen = document.getElementById('imagen');

            if (nomProduct.value.trim() === '') {
                document.getElementById('nom_product_error').textContent = 'Ingrese el nombre del producto.';
                isValid = false;
            }

            if (cantidad.value.trim() === '') {
                document.getElementById('cantidad_error').textContent = 'Ingrese la cantidad del producto.';
                isValid = false;
            }

            if (fechaVenc.value.trim() === '') {
                document.getElementById('fecha_venc_error').textContent = 'Ingrese la fecha de vencimiento del producto.';
                isValid = false;
            }

            if (descripcion.value.trim() === '') {
                document.getElementById('descripcion_error').textContent = 'Ingrese la descripción del producto.';
                isValid = false;
            }

            if (idEstado.value === '') {
                document.getElementById('id_estado_error').textContent = 'Seleccione el estado del producto.';
                isValid = false;
            }

            if (precio.value.trim() === '') {
                document.getElementById('precio_error').textContent = 'Ingrese el precio del producto.';
                isValid = false;
            }

            if (imagen.files.length === 0) {
                document.getElementById('imagen_error').textContent = 'Seleccione una imagen del producto.';
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>

</html>
