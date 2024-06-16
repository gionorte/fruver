<?php
session_start();
if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../inicio sesion/iniciosesion.php");
    exit();
}

include("../includes/conexion.php");

$nom_product = $_POST['nom_product'];
$cantidad = $_POST['cantidad'];
$fecha_venc = $_POST['fecha_venc'];
$descripcion = $_POST['descripcion'];
$id_estado = $_POST['id_estado'];
$precio = $_POST['precio'];
$imagen = $_FILES['imagen']['name'];

// Validación y carga de la imagen
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["imagen"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Comprueba si el archivo es una imagen real o un archivo falso
$check = getimagesize($_FILES["imagen"]["tmp_name"]);
if($check === false) {
    die("El archivo no es una imagen.");
}

// Comprueba si el archivo ya existe
if (file_exists($target_file)) {
    die("Lo siento, el archivo ya existe.");
}

// Comprueba el tamaño del archivo
if ($_FILES["imagen"]["size"] > 500000) {
    die("Lo siento, tu archivo es demasiado grande.");
}

// Permitir ciertos formatos de archivo
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    die("Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.");
}

// Intenta subir el archivo
if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
    die("Lo siento, hubo un error al subir tu archivo.");
}

// Insertar los datos en la base de datos
$stmt = $conn->prepare("INSERT INTO productos (Nom_Product, Cantidad, Fecha_Venc, Descripcion, Estado, Precio, Imagen) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sisssds", $nom_product, $cantidad, $fecha_venc, $descripcion, $id_estado, $precio, $imagen);

if ($stmt->execute()) {
    echo "<script>alert('Registro exitoso'); window.location.href = 'regis-producto.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
