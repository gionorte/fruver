<?php
session_start();
if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../inicio sesion/iniciosesion.php");
    exit();
}

include("../includes/conexion.php");
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
</head>
<body>
    <main id="hero">
        <header>
            <div class="logo">
                <h1>
                    <a href="empleado.php"><img src="img/icono.png" alt="icono" style="width: 70px;"></a>
                </h1>
            </div>
        </header>
        <div class="form-container inicio">
            <h2>Gestión de Tareas</h2>
            <table id="productoTabla" class="display">
                <thead>
                <tr>
                        <th>Id de Tarea</th>
                        <th>Numero de Documento</th>
                        <th>Actividad</th>
                        <th>Descripción</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM tarea";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['Id_Tarea'] . "</td>";
                        echo "<td>" . $row['Num_Doc'] . "</td>";
                        echo "<td>" . $row['Actividad'] . "</td>";
                        echo "<td>" . $row['Descripcion'] . "</td>";
                        echo "<td>" . $row['Fecha_Inicio'] . "</td>";
                        echo "<td>" . $row['Fecha_Fin'] . "</td>";
                        echo "<td>" . $row['Id_Estado'] . "</td>";
                        echo "<td>" . $row['Observacion'] . "</td>";
                        echo "<td>
                                <button onclick=\"editProduct('" . $row['Id_Tarea'] . "')\">Editar</button> <br><br>
                                <button onclick=\"deleteProduct('" . $row['Id_Tarea'] . "')\">Eliminar</button>
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
    <script>
        $(document).ready(function() {
            $('#productoTabla').DataTable({
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

        function editProduct(id) {
            window.location.href = `modificar_producto.php?id=${id}`;
        }

        function deleteProduct(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                window.location.href = `eliminar_producto.php?id=${id}`;
            }
        }

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
            doc.text("Productos", 40, 50);
            doc.autoTable({ html: '#' + tableID, startY: 60 });
            doc.save('productos.pdf');
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs
