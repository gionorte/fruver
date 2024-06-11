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
    <link rel="stylesheet" href="tu_archivo_css.css"> <!-- Reemplaza "tu_archivo_css.css" con la ruta de tu archivo CSS -->
    <link href="img/icono.png" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
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
    <script>
        $(document).ready(function() {
            $('#inventarioTabla').DataTable({
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
                }
            });
        });

        function exportTableToExcel(tableID, filename = ''){
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
            
            filename = filename?filename+'.xls':'excel_data.xls';
            
            downloadLink = document.createElement("a");
            
            document.body.appendChild(downloadLink);
            
            if(navigator.msSaveOrOpenBlob){
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
                downloadLink.download = filename;
                downloadLink.click();
            }
        }

        function exportTableToPDF(tableID) {
            var { jsPDF } = window.jspdf;
            var doc = new jsPDF('p', 'pt', 'a4');
            // Agregar el logo al documento PDF
            var img = new Image();
            img.src = 'img/icono.png'; // Ruta del logo
            doc.addImage(img, 'PNG', 40, 20, 70, 70); // Posición y tamaño del logo

            // Agregar la tabla al documento PDF
            doc.text("Inventario", 40, 120); // Título de la tabla
            doc.autoTable({ html: '#' + tableID, startY: 140 }); // Inicio de la tabla

            // Guardar el documento PDF
            doc.save('inventario.pdf');
        }
    </script>
</body>
</html>
