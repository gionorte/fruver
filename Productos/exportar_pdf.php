<?php
// Iniciar sesión (si no está iniciada)
session_start();

// Verificar si no hay sesión activa de usuario
if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../inicio_sesion/iniciosesion.php");
    exit();
}

// Incluir la conexión a la base de datos
include("../includes/conexion.php");

// Incluir FPDF
require('../includes/fpdf/fpdf.php');

// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Encabezado
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, 'Lista de Productos', 0, 1, 'C');

// Consulta SQL para obtener los datos de la tabla productos
$sql = "SELECT Id_Producto, Nom_Product, Cantidad, Fecha_Venc, Descripcion, Estado, Precio FROM productos";
$result = $conn->query($sql);

// Encabezados de tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 8, 'ID', 1);
$pdf->Cell(30, 8, 'Nombre', 1);
$pdf->Cell(20, 8, 'Cantidad.', 1);
$pdf->Cell(30, 8, 'Fech Venc.', 1);
$pdf->Cell(40, 8, 'Descripción', 1);
$pdf->Cell(20, 8, 'Estado', 1);
$pdf->Cell(20, 8, 'Precio', 1);
$pdf->Ln();

// Configurar la fuente y tamaño para los datos de la tabla
$pdf->SetFont('Arial', '', 10);

// Datos de la tabla desde la base de datos
while ($row = $result->fetch_assoc()) {
    // Ajustar el contenido de las celdas para que quepan en el espacio definido
    $pdf->Cell(20, 8, $row['Id_Producto'], 1);
    $pdf->Cell(30, 8, utf8_decode(substr($row['Nom_Product'], 0, 18)), 1); // Limitar el nombre a 18 caracteres
    $pdf->Cell(20, 8, $row['Cantidad'], 1);
    $pdf->Cell(30, 8, $row['Fecha_Venc'], 1);
    $pdf->Cell(40, 8, utf8_decode(substr($row['Descripcion'], 0, 30)), 1); // Limitar la descripción a 30 caracteres
    $pdf->Cell(20, 8, utf8_decode(substr($row['Estado'], 0, 10)), 1); // Limitar el estado a 10 caracteres
    $pdf->Cell(20, 8, $row['Precio'], 1);
    $pdf->Ln();
}

// Nombre del archivo PDF para descarga
$filename = 'productos.pdf';

// Salida del archivo PDF para descarga
$pdf->Output('D', $filename);

$conn->close();
?>
