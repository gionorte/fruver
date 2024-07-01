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

// Incluir PhpSpreadsheet
require_once '../vendor/autoload.php';

// Crear instancia de PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Encabezado del archivo Excel
$sheet->setCellValue('A1', 'Lista de Productos');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);

// Consulta SQL para obtener los datos de la tabla productos
$sql = "SELECT Id_Producto, Nom_Product, Cantidad, Fecha_Venc, Descripcion, Estado, Precio FROM productos";
$result = $conn->query($sql);

// Encabezados de tabla
$sheet->setCellValue('A3', 'ID');
$sheet->setCellValue('B3', 'Nombre');
$sheet->setCellValue('C3', 'Cantidad');
$sheet->setCellValue('D3', 'Fecha de Vencimiento');
$sheet->setCellValue('E3', 'Descripción');
$sheet->setCellValue('F3', 'Estado');
$sheet->setCellValue('G3', 'Precio');

$row = 4; // Fila inicial para los datos

// Datos de la tabla desde la base de datos
while ($row_data = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, $row_data['Id_Producto']);
    $sheet->setCellValue('B' . $row, $row_data['Nom_Product']);
    $sheet->setCellValue('C' . $row, $row_data['Cantidad']);
    $sheet->setCellValue('D' . $row, $row_data['Fecha_Venc']);
    $sheet->setCellValue('E' . $row, $row_data['Descripcion']);
    $sheet->setCellValue('F' . $row, $row_data['Estado']);
    $sheet->setCellValue('G' . $row, $row_data['Precio']);
    $row++;
}

// Establecer anchos de columna adecuados
$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('C')->setWidth(10);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(40);
$sheet->getColumnDimension('F')->setWidth(10);
$sheet->getColumnDimension('G')->setWidth(15);

// Estilo para el encabezado de tabla
$header_style = [
    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
    'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '0070C0']],
];

// Aplicar estilo al encabezado de tabla
$sheet->getStyle('A3:G3')->applyFromArray($header_style);

// Nombre del archivo Excel para descarga
$filename = 'productos.xlsx';

// Configurar cabeceras para descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Crear el escritor para Excel y descargar archivo
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

$conn->close();
?>
