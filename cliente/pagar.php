<?php
session_start();
include '../includes/conexion.php';

if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../iniciosesion.php");
    exit();
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha subido un archivo válido
    if (isset($_FILES["comprobante"]) && $_FILES["comprobante"]["error"] == UPLOAD_ERR_OK) {
        $comprobante_temp = $_FILES["comprobante"]["tmp_name"];
        $comprobante_nombre = $_FILES["comprobante"]["name"];
        
        // Mover el archivo subido a una ubicación específica en tu servidor
        $carpeta_destino = "../uploads/";
        $ruta_comprobante = $carpeta_destino . $comprobante_nombre;
        
        if (move_uploaded_file($comprobante_temp, $ruta_comprobante)) {
            // Archivo subido correctamente
            // Obtener el total del carrito de compras enviado desde el formulario
            if (isset($_POST['total'])) {
                $totalCarrito = $_POST['total'];
                
                // Obtener el id_producto desde la base de datos según el carrito del usuario
                $idsProductos = array_keys($_SESSION['carrito']);
                $idsProductosString = implode(',', $idsProductos);
                
                // Consultar el primer producto del carrito (aquí se puede ajustar la lógica según tu aplicación)
                $sql_producto = "SELECT Id_Producto, Precio FROM productos WHERE Id_Producto IN ($idsProductosString) LIMIT 1";
                $result_producto = $conn->query($sql_producto);
                
                if ($result_producto && $result_producto->num_rows > 0) {
                    $row_producto = $result_producto->fetch_assoc();
                    $id_producto = $row_producto['Id_Producto'];
                    $precio = $row_producto['Precio'];
                    
                    // Consultar el lote desde la tabla lote (ejemplo de consulta)
                    $sql_lote = "SELECT Lote FROM lote WHERE Id_Producto = $id_producto"; // Ajusta según la estructura de tu tabla
                    $result_lote = $conn->query($sql_lote);
                    
                    if ($result_lote && $result_lote->num_rows > 0) {
                        $row_lote = $result_lote->fetch_assoc();
                        $lote = $row_lote['lote'];
                        
                        // Insertar información de la venta en la tabla `ventas`
                        $sql_insert = "INSERT INTO ventas (Id_Producto, Lote, Precio, En_Proceso, Total_Ventas, Comprobante_Pago)
                                       VALUES (?, ?, ?, ?, ?, ?)";
                        
                        // Preparar la declaración
                        $stmt = $conn->prepare($sql_insert);
                        
                        // Valores para la venta
                        $en_proceso = 1; // Ejemplo de estado, ajustar según tu lógica
                        $total_ventas = $totalCarrito; // Usando el total del carrito
                        $comprobante_pago = $ruta_comprobante; // Ruta del comprobante de pago subido
                        
                        // Bind parameters
                        $stmt->bind_param("isdiis", $id_producto, $lote, $precio, $en_proceso, $total_ventas, $comprobante_pago);
                        
                        // Ejecutar la declaración
                        if ($stmt->execute()) {
                            // Redirigir a la página de confirmación
                            header("Location: confirmacion.php");
                            exit();
                            
                        } else {
                            echo "Error al registrar la venta: " . $stmt->error . "<br>";
                        }
                        
                        // Cerrar la declaración
                        $stmt->close();
                        
                    } else {
                        echo "No se encontró el lote para el producto.<br>";
                    }
                    
                } else {
                    echo "No se encontró ningún producto en el carrito.<br>";
                }
                
            }
        } else {
            // Error al mover el archivo
            echo "Error al subir el comprobante de pago.<br>";
        }
    } else {
        // No se ha subido ningún archivo o ocurrió algún error
        echo "Debe seleccionar un archivo de imagen válido.<br>";
    }
}

// Cerrar la conexión
$conn->close();
?>
