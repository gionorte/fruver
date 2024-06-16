<?php
session_start();
include("../includes/conexion.php");


session_start();
if (!isset($_SESSION['Id_Cargo'])) {
    header("Location: ../inicio sesion/iniciosesion.php");
    exit();
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM productos WHERE Id_Producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
} else {
    header("Location: gestion_productos.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $fecha_venc = $_POST['fecha_venc'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];
    $precio = $_POST['precio'];
    $imagen = $_FILES['imagen']['name'];

    if ($imagen) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($imagen);
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file);

        $sql = "UPDATE productos SET Nom_Product=?, Cantidad=?, Fecha_Venc=?, Descripcion=?, Estado=?, Precio=?, Imagen=? WHERE Id_Producto=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisssdsi", $nombre, $cantidad, $fecha_venc, $descripcion, $estado, $precio, $imagen, $id);
    } else {
        $sql = "UPDATE productos SET Nom_Product=?, Cantidad=?, Fecha_Venc=?, Descripcion=?, Estado=?, Precio=? WHERE Id_Producto=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisssdi", $nombre, $cantidad, $fecha_venc, $descripcion, $estado, $precio, $id);
    }

    if ($stmt->execute()) {
        header("Location: gestion_productos.php");
        exit();
    } else {
        echo "Error al actualizar el producto.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <link rel="stylesheet" href="../Assets/css/lis_regis.css">
    <link href="../Assets/img/icono.png" rel="icon">
</head>
<body>
    <main id="hero">
        <header>
            <div class="logo">
                <h1>
                    <a href="lista-produc.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 70px;"></a>
                </h1>
            </div>
        </header>
        <div class="form-container inicio">
            <h2>Modificar Producto</h2>
            <form action="modificar_producto.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nombre">Nombre de Producto:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $product['Nom_Product']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad" name="cantidad" value="<?php echo $product['Cantidad']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="fecha_venc">Fecha de Vencimiento:</label>
                    <input type="date" id="fecha_venc" name="fecha_venc" value="<?php echo $product['Fecha_Venc']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" required><?php echo $product['Descripcion']; ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <input type="text" id="estado" name="estado" value="<?php echo $product['Estado']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" step="0.01" id="precio" name="precio" value="<?php echo $product['Precio']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" name="imagen">
                    <img src="../uploads/<?php echo $product['Imagen']; ?>" alt="imagen_producto" style="width: 100px;">
                </div>
                
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </main>
</body>
</html>
