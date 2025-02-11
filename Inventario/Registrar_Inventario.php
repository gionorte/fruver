<?php
session_start();
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
    <title>Registro de Inventarios</title>
    <link rel="stylesheet" href="../Assets/css/Inventario.css">
    <link href="../Assets/img/icono.png" rel="icon">
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
            <h2>Registro de Inventarios</h2>
            <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                <p class="success-message">Registro exitoso</p>
            <?php endif; ?>
            <form id="inventoryForm" action="Procesar_Inventario.php" method="POST">
                <div class="form-group">
                    <label for="id_empleado">ID Empleado:</label>
                    <select id="id_empleado" name="id_empleado">
                        <option value="" disabled selected>Seleccione un ID de empleado</option>
                        <?php
                        include("../includes/conexion.php"); // Asegúrate de que este archivo está configurado correctamente
                        $sql_empleado = "SELECT Id_Empleado FROM empleado"; // Cambia el nombre de las columnas según tu base de datos
                        $result_empleado = $conn->query($sql_empleado);
                        if ($result_empleado->num_rows > 0) {
                            while ($row_empleado = $result_empleado->fetch_assoc()) {
                                echo "<option value='" . $row_empleado['Id_Empleado'] . "'>" . $row_empleado['Id_Empleado'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay empleados disponibles</option>";
                        }
                        $conn->close();
                        ?>
                    </select>
                    <span class="error" id="errorEmpleado"></span>
                </div>
                <div class="form-group">
                    <label for="nom_product">Nombre del Producto:</label>
                    <input type="text" id="nom_product" name="nom_product" placeholder="Ingrese el nombre del producto">
                    <span class="error" id="errorProducto"></span>
                </div>
                <div class="form-group">
                    <label for="lote">Lote:</label>
                    <select id="lote" name="lote">
                        <option value="" disabled selected>Seleccione un lote</option>
                        <?php
                        include("../includes/conexion.php"); // Asegúrate de que este archivo está configurado correctamente
                        $sql_lote = "SELECT lote FROM lote"; // Cambia el nombre de las columnas según tu base de datos
                        $result_lote = $conn->query($sql_lote);
                        if ($result_lote->num_rows > 0) {
                            while ($row_lote = $result_lote->fetch_assoc()) {
                                echo "<option value='" . $row_lote['lote'] . "'>" . $row_lote['lote'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay lotes disponibles</option>";
                        }
                        $conn->close();
                        ?>
                    </select>
                    <span class="error" id="errorLote"></span>
                </div>
                <div class="form-group">
                    <label for="id_producto">ID Producto:</label>
                    <select id="id_producto" name="id_producto">
                        <option value="" disabled selected>Seleccione un ID de producto</option>
                        <?php
                        include("../includes/conexion.php"); // Asegúrate de que este archivo está configurado correctamente
                        $sql_producto = "SELECT Id_Producto FROM productos"; // Cambia el nombre de las columnas según tu base de datos
                        $result_producto = $conn->query($sql_producto);
                        if ($result_producto->num_rows > 0) {
                            while ($row_producto = $result_producto->fetch_assoc()) {
                                echo "<option value='" . $row_producto['Id_Producto'] . "'>" . $row_producto['Id_Producto'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay productos disponibles</option>";
                        }
                        $conn->close();
                        ?>
                    </select>
                    <span class="error" id="errorIdProducto"></span>
                </div>
                <div class="form-group">
                    <label for="id_venta">ID Venta:</label>
                    <select id="id_venta" name="id_venta">
                        <option value="" disabled selected>Seleccione un ID de venta</option>
                        <?php
                        include("../includes/conexion.php"); // Asegúrate de que este archivo está configurado correctamente
                        $sql_venta = "SELECT Id_Venta FROM ventas"; // Cambia el nombre de las columnas según tu base de datos
                        $result_venta = $conn->query($sql_venta);
                        if ($result_venta->num_rows > 0) {
                            while ($row_venta = $result_venta->fetch_assoc()) {
                                echo "<option value='" . $row_venta['Id_Venta'] . "'>" . $row_venta['Id_Venta'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay ventas disponibles</option>";
                        }
                        $conn->close();
                        ?>
                    </select>
                    <span class="error" id="errorIdVenta"></span>
                </div>
                <button type="submit">Registrar</button>
            </form>
        </div>
    </main>
    <script src="../Assets/js/validacion_inventario.js"></script>
</body>

</html>
