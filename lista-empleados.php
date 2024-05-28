<?php
session_start();
if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: iniciosesion.php");
    exit();
}
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut - Gestión de Registros</title>
    <link rel="stylesheet" href="css/lista_em.css">
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
            <h2>Gestión de Registros</h2>
            <table id="registroTabla" class="display">
                <thead>
                    <tr>
                        <th>Número de Documento</th>
                        <th>Tipo de Documento</th>
                        <th>Primer Nombre</th>
                        <th>Segundo Nombre</th>
                        <th>Primer Apellido</th>
                        <th>Segundo Apellido</th>
                        <th>Género</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Contraseña</th>
                        <th>Cargo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM persona";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['Num_Doc'] . "</td>";
                        echo "<td>" . $row['Tipo_Doc'] . "</td>";
                        echo "<td>" . $row['Prim_Nombre'] . "</td>";
                        echo "<td>" . $row['Seg_Nombre'] . "</td>";
                        echo "<td>" . $row['Prim_Apellido'] . "</td>";
                        echo "<td>" . $row['Seg_Apellido'] . "</td>";
                        echo "<td>" . $row['Genero'] . "</td>";
                        echo "<td>" . $row['Telefono'] . "</td>";
                        echo "<td>" . $row['Correo'] . "</td>";
                        echo "<td>" . $row['Contrasena'] . "</td>"; // Aquí se muestra la contraseña
                        echo "<td>" . $row['Id_Cargo'] . "</td>";
                        echo "<td>";
                        echo "<button onclick=\"editRecord('" . $row['Num_Doc'] . "')\">Editar</button> <br><br>";
                        echo "<button onclick=\"deleteRecord('" . $row['Num_Doc'] . "')\">Eliminar</button>";
                        echo "</td>";
                        echo "</tr>";

                    }
                    ?>
                </tbody>
            </table>
            <button class="export" onclick="exportTableToExcel('registroTabla', 'registros')">Exportar a Excel</button>
            <button class="export" onclick="exportTableToPDF('registroTabla')">Exportar a PDF</button>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registroTabla').DataTable({
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

        function editRecord(num_doc) {
            window.location.href = `modif-emple.php?num_doc=${num_doc}`;
        }

        function deleteRecord(num_doc) {
            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                window.location.href = `delete_record.php?num_doc=${num_doc}`;
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
            doc.text("Registros", 40, 50);
            doc.autoTable({ html: '#' + tableID, startY: 60 });
            doc.save('Empleados.pdf');
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
</body>
</html>
