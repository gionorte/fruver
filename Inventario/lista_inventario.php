<?php
include("../includes/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM inventario WHERE Id_FlujoInven = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Registro eliminado correctamente";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<?php
session_start();
include("../includes/conexion.php");

if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../inicio_sesion/iniciosesion.php");
    exit();
}

// Check user permissions
$can_edit = $_SESSION['Id_Cargo'] == 1; // assuming 1 is the admin role
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
            <h2>Gestión de Inventario</h2>
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
                        echo "<td>";
                        if ($can_edit) {
                            echo "<button onclick=\"editInventory('" . $row['Id_FlujoInven'] . "')\">Editar</button> <br><br>";
                            echo "<button onclick=\"deleteInventory('" . $row['Id_FlujoInven'] . "')\">Eliminar</button>";
                        } else {
                            echo "Sin permisos";
                        }
                        echo "</td>";
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

        function editInventory(id) {
            if (confirm('¿Estás seguro de que deseas editar este inventario?')) {
                window.location.href = `editar_registro.php?id=${id}`;
            }
        }

        function deleteInventory(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este inventario?')) {
                $.ajax({
                    url: 'eliminar_registro.php',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    }
                });
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
