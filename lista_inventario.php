<?php
// Incluir el archivo de conexión a la base de datos
include("conexion.php");

// Verificar si la conexión se ha establecido correctamente
if ($conn === false) {
    die("Error: No se pudo conectar a la base de datos.");
}

// Realizar la consulta SQL para obtener los datos del inventario
$sql = "SELECT * FROM inventario";
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if ($result === false) {
    die("Error: La consulta SQL ha fallado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut - Gestión de Inventario</title>
    <link rel="stylesheet" href="css/lis_invent.css">
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
            <h2>Gestión de Inventario</h2>
            <table id="inventarioTabla" class="display">
                <thead>
                    <tr>
                        <th>Id de Flujo de Inventario</th>
                        <th>Id de Empleado</th>
                        <th>Nombre del Producto</th>
                        <th>Lote</th>
                        <th>Id de Producto</th>
                        <th>Id de Venta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Iterar sobre los resultados de la consulta y mostrarlos en la tabla
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['Id_FlujoInven'] . "</td>";
                        echo "<td>" . $row['Id_Empleado'] . "</td>";
                        echo "<td>" . $row['Nom_Product'] . "</td>";
                        echo "<td>" . $row['Lote'] . "</td>";
                        echo "<td>" . $row['Id_Producto'] . "</td>";
                        echo "<td>" . $row['Id_Venta'] . "</td>";
                        echo "<td>
                        <button class='editar' onclick='editarRegistro(" . $row['Id_FlujoInven'] . ")'>Editar</button> <br><br>
                        <button class='eliminar' onclick='eliminarRegistro(" . $row['Id_FlujoInven'] . ")'>Eliminar</button>
                    </td>";
                    echo "</tr>";
                    }
                    ?>
                </tbody>
            </table> 
            <button class="export" onclick="exportTableToExcel('inventarioTabla', 'inventario')">Exportar a Excel</button>
            <button class="export" onclick="exportTableToPDF('inventarioTabla')">Exportar a PDF</button>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#inventarioTabla').DataTable({
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

            table.buttons().container().appendTo('#inventarioTabla_wrapper .col-md-6:eq(0)');
        });

        function exportTableToExcel(tableID, filename = '') {
            var table = $('#inventarioTabla').DataTable();
            table.buttons('.buttons-excel').trigger();
        }

        function exportTableToPDF(tableID) {
            var table = $('#inventarioTabla').DataTable();
            table.buttons('.buttons-pdf').trigger();
        }
    </script> 
</body>
</html>
