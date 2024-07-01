<?php
session_start();
if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../inicio_sesion/iniciosesion.php");
    exit();
}


include("../includes/conexion.php");

// Consulta SQL para obtener los registros de la base de datos
$sql = "SELECT * FROM persona";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut - Gestión de Registros</title>
    <link rel="stylesheet" href="../Assets/css/lista_em.css">
    <link href="img/icono.png" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
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
                        <th>Cargo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mostrar los registros en la tabla
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar DataTable
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

        // Función para editar un registro
        function editRecord(num_doc) {
            window.location.href = `modif-emple.php?num_doc=${num_doc}`;
        }

        // Función para eliminar un registro
        function deleteRecord(num_doc) {
            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                window.location.href = `delete_record.php?num_doc=${num_doc}`;
            }
        }

        // Función para exportar la tabla a Excel
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

       // Función para exportar la tabla a PDF
function exportTableToPDF(tableID) {
    var { jsPDF } = window.jspdf;
    var doc = new jsPDF('p', 'pt', 'a4');
    var logo = new Image();
    logo.src = 'img/icono.png';

    // Agregar el logo y el título
    doc.addImage(logo, 'PNG', 40, 10, 70, 70);
    doc.setFontSize(18);
    doc.text(" Lista de Empleados ", 120, 50);

    // Obtener los datos de la tabla
    var table = document.getElementById(tableID);

    // Configurar opciones para la exportación de PDF
    var options = {
        startY: 100
    };

    // Remover la columna de "Acciones" antes de exportar
    $(table).find('thead th:last-child, tbody td:last-child').remove();

    // Agregar la tabla al PDF
    doc.autoTable({ html: table, ...options });

    // Descargar el archivo PDF
    doc.save('Empleados.pdf');
}

</script>
</body>
</html>

