<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: iniciosesion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut - Gestión de Productos</title>
    <link rel="stylesheet" href="css/list-prod.css">
    <link href="img/icono.png" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
</head>
<body>
    <main id="hero">
        <header>
            <div class="logo">
                <h1>
                    <a href="admin.php"><img src="img/icono.png" alt="icono" style="width: 70px;"></a>
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
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['Id_Producto'] . "</td>";
                        echo "<td>" . $row['Nom_Product'] . "</td>";
                        echo "<td>" . $row['Cantidad'] . "</td>";
                        echo "<td>" . $row['Fecha_Venc'] . "</td>";
                        echo "<td>" . $row['Descripcion'] . "</td>";
                        echo "<td>" . $row['Id_Estado'] . "</td>";
                        echo "<td>" . $row['Precio'] . "</td>";
                        echo "<td><img src='uploads/" . $row['imagen'] . "' alt='imagen_producto' style='width: 100px;'></td>";
                        echo "<td>
                                <button onclick=\"editProduct('" . $row['Id_Producto'] . "')\">Editar</button> <br><br>
                                <button onclick=\"deleteProduct('" . $row['Id_Producto'] . "')\">Eliminar</button>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button class="export" onclick="exportTableToExcel('productoTabla', 'productos')">Exportar a Excel</button>
            <button class="export" onclick="exportTableToPDF('productoTabla')">Exportar a PDF</button>
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
    <script>
        $(document).ready(function() {
            var table = $('#productoTabla').DataTable({
                language: {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron registros",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });

            table.buttons().container().appendTo( '#productoTabla_wrapper .col-md-6:eq(0)' );
        });

        function editProduct(id) {
            window.location.href = `modificar_producto.php?id=${id}`;
        }

        function deleteProduct(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                window.location.href = `eliminar_producto.php?id=${id}`;
            }
        }

        function exportTableToExcel(tableID, filename = '') {
            var table = $('#productoTabla').DataTable();
            table.buttons('.buttons-excel').trigger();
        }

        function exportTableToPDF(tableID) {
            var table = $('#productoTabla').DataTable();
            table.buttons('.buttons-pdf').trigger();
        }
    </script>
</body>
</html>
