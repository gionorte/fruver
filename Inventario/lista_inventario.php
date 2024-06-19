<?php
session_start();
include("../includes/conexion.php");

if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../inicio sesion/iniciosesion.php");
    exit();
}
<<<<<<< HEAD

// Realizar la consulta SQL para obtener los datos del inventario
$sql = "SELECT * FROM inventario WHERE cantidad > 0"; // Asegurarse de que solo se seleccionen productos disponibles
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if ($result === false) {
    die("Error: La consulta SQL ha fallado.");
}

// Inicializar la variable para verificar si hay productos disponibles
$productos_disponibles = $result->num_rows > 0;
=======
>>>>>>> cdf2cfa8573736228f9a15c07ea1a10a45139099
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut - Gestión de Inventario</title>
    <link rel="stylesheet" href="../Assets/css/lis_invent.css">
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
                    <a href="../Admin/admin.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a>
                </h1>
            </div>
        </header>
        <div class="form-container inicio">
            <h2>Gestión de Inventario</h2>
<<<<<<< HEAD
            <?php if ($productos_disponibles): ?>
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
                                <button class='editar' onclick='editarRegistro(" . $row['Id_FlujoInven'] . ")'>Editar</button><br><br>
                                <button class='eliminar' onclick='eliminarRegistro(" . $row['Id_FlujoInven'] . ")'>Eliminar</button>
                                </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <button class="export" onclick="exportTableToExcel('inventarioTabla', 'inventario')">Exportar a Excel</button>
                <button class="export" onclick="exportTableToPDF('inventarioTabla')">Exportar a PDF</button>
            <?php else: ?>
                <p>No hay productos disponibles en el inventario.</p>
            <?php endif; ?>
=======
            <table id="inventarioTabla" class="display">
                <thead>
                    <tr>
                        <th>Id de Flujo</th>
                        <th>Id de Empleado</th>
                        <th>Nombre del Producto</th>
                        <th>Lote</th>
                        <th>Cantidad</th>
                        <th>Id de Producto</th>
                        <th>Id de Venta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM inventario";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['Id_FlujoInven'] . "</td>";
                        echo "<td>" . $row['Id_Empleado'] . "</td>";
                        echo "<td>" . $row['Nom_Product'] . "</td>";
                        echo "<td>" . $row['Lote'] . "</td>";
                        echo "<td>" . $row['Cantidad'] . "</td>";
                        echo "<td>" . $row['Id_Producto'] . "</td>";
                        echo "<td>" . $row['Id_Venta'] . "</td>";
                        echo "<td>
                                <button onclick=\"editInventory('" . $row['Id_FlujoInven'] . "')\">Editar</button> <br><br>
                                <button onclick=\"deleteInventory('" . $row['Id_FlujoInven'] . "')\">Eliminar</button>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button class="export" onclick="exportTableToExcel('inventarioTabla', 'inventario')">Exportar a Excel</button>
            <button class="export" onclick="exportTableToPDF('inventarioTabla')">Exportar a PDF</button>
>>>>>>> cdf2cfa8573736228f9a15c07ea1a10a45139099
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

        function editInventory(id) {
            window.location.href = `modificar_inventario.php?id=${id}`;
        }

        function deleteInventory(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este inventario?')) {
                window.location.href = `eliminar_inventario.php?id=${id}`;
            }
        }

        function exportTableToExcel(tableID, filename = '') {
            var table = $('#' + tableID).DataTable();
            table.buttons('.buttons-excel').trigger();
        }

        function exportTableToPDF(tableID) {
            var table = $('#' + tableID).DataTable();
            table.buttons('.buttons-pdf').trigger();
        }
    </script>
</body>
</html>
