
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagar con Nequi</title>
</head>
<body>
    <h1>Pagar con Nequi</h1>
    <form action="procesar_pago_nequi.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required><br>
        <input type="hidden" name="total" value="<?php echo $total; ?>">
        <button type="submit">Proceder con Nequi</button>
    </form>
</body>
</html>
