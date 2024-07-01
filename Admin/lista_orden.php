<?php
session_start();
include("../includes/conexion.php");

if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../inicio sesion/iniciosesion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut - Órdenes de Compra</title>
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
                            echo '<a href="../Admin/admin.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a>';
                        } elseif ($_SESSION['Id_Cargo'] == 2) {
                            echo '<a href="../Admin/empleado.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a>';
                        }
                    } else {
                        echo '<a href="../inicio sesion/iniciosesion.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a>';
                    }
                    ?>
                </h1>
            </div>
        </header>
        <div class="form-container inicio">
            <h2>Órdenes de Compra</h2>
            <table id="ordenCompraTabla" class="display">
                <thead>
                    <tr>
                        <th>Id de Orden</th>
                        <th>Lote</th>
                        <th>Nombre de Producto</th>
                        <th>Descripción</th>
                        <th>Tipo de Documento</th>
                        <th>Número de Documento</th>
                        <th>Nombre del Cliente</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Nombre del Empleado</th>
                        <th>Cantidad de Producto</th>
                        <th>Precio</th>
                        <th>Id del Producto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM orden_compra";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['Id_Orden'] . "</td>";
                        echo "<td>" . $row['Lote'] . "</td>";
                        echo "<td>" . $row['Nom_Product'] . "</td>";
                        echo "<td>" . $row['Descripcion'] . "</td>";
                        echo "<td>" . $row['Tipo_Doc'] . "</td>";
                        echo "<td>" . $row['Num_Doc'] . "</td>";
                        echo "<td>" . $row['Nom_Cliente'] . "</td>";
                        echo "<td>" . $row['Telefono'] . "</td>";
                        echo "<td>" . $row['Correo'] . "</td>";
                        echo "<td>" . $row['Nom_Emple'] . "</td>";
                        echo "<td>" . $row['Cantidad_Product'] . "</td>";
                        echo "<td>" . $row['Precio'] . "</td>";
                        echo "<td>" . $row['Id_Producto'] . "</td>";
                        echo "<td>
                                <button onclick=\"editOrder('" . $row['Id_Orden'] . "')\">Editar</button> <br><br>
                                <button onclick=\"deleteOrder('" . $row['Id_Orden'] . "')\">Eliminar</button>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button class="export" onclick="exportTableToExcel('ordenCompraTabla', 'ordenes_compra')">Exportar a Excel</button>
            <button class="export" onclick="exportTableToPDF('ordenCompraTabla')">Exportar a PDF</button>
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
            var table = $('#ordenCompraTabla').DataTable({
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

            table.buttons().container().appendTo('#ordenCompraTabla_wrapper .col-md-6:eq(0)');
        });

        function editOrder(id) {
            window.location.href = `modificar_orden.php?id=${id}`;
        }

        function deleteOrder(id) {
            if (confirm('¿Estás seguro de que deseas eliminar esta orden?')) {
                window.location.href = `eliminar_orden.php?id=${id}`;
            }
        }

        function exportTableToExcel(tableID, filename = '') {
            var table = $('#ordenCompraTabla').DataTable();
            table.buttons('.buttons-excel').trigger();
        }

        function exportTableToPDF(tableID) {
            var table = $('#ordenCompraTabla').DataTable();
            table.buttons('.buttons-pdf').trigger();
        }
    </script>
</body>
</html>
