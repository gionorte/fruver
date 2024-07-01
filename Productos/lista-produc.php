<?php
session_start();
include("../includes/conexion.php");

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
    <title>Inzufrut - Gestión de Productos</title>
    <link rel="stylesheet" href="../Assets/css/list-prod.css">
    <link href="../Assets/img/icono.png" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
</head>
<body>
    <main id="hero">
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

        <div class="form-container inicio">
            <h2>Gestión de Productos</h2>
            <table id="productoTabla" class="display">
                <thead>
                    <tr>
                        <th>Id de Producto</th>
                        <th>Nombre de Producto</th>
                        <th>Cantidad</th>
                        <th>Fecha de Vencimiento</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM productos";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['Id_Producto'] . "</td>";
                        echo "<td>" . $row['Nom_Product'] . "</td>";
                        echo "<td>" . $row['Cantidad'] . "</td>";
                        echo "<td>" . $row['Fecha_Venc'] . "</td>";
                        echo "<td>" . $row['Descripcion'] . "</td>";
                        echo "<td>" . $row['Estado'] . "</td>";
                        echo "<td>" . $row['Precio'] . "</td>";
                        echo "<td><img src='../uploads/" . $row['Imagen'] . "' alt='imagen_producto' style='width: 100px;'></td>";
                        echo "<td>
                                <button onclick=\"editProduct('" . $row['Id_Producto'] . "')\">Editar</button> <br><br>
                                <button onclick=\"deleteProduct('" . $row['Id_Producto'] . "')\">Eliminar</button>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button class="export" onclick="location.href='exportar_excel.php';">Exportar a Excel</button>

            <button class="export" onclick="location.href='exportar_pdf.php';">Exportar a Pdf</button>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

    <!-- Script personalizado para DataTables y funciones de exportación -->
    <script>
        $(document).ready(function () {
            var table = $('#productoTabla').DataTable({
                language: {
                    // Configuración de idioma para DataTables
                },
                buttons: [
                    'copy', 'excel', 'pdf' // Botones de exportación disponibles
                ]
            });

            // Añadir los botones al contenedor adecuado en el DataTable
            table.buttons().container().appendTo('#productoTabla_wrapper .col-md-6:eq(0)');
        });

        // Funciones adicionales si las necesitas, como editProduct y deleteProduct
        function editProduct(productId) {
            // Implementa la lógica para editar un producto
            console.log('Editar producto con ID: ' + productId);
        }

        function deleteProduct(productId) {
            // Implementa la lógica para eliminar un producto
            console.log('Eliminar producto con ID: ' + productId);
        }
    </script>
</body>
</html>
