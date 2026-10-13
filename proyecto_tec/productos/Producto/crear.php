<?php
require_once __DIR__ . "/../../controllers/ProductoController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"] ?? "";
    $precio = $_POST["precio"] ?? 0;
    $cantidad = $_POST["cantidad"] ?? 0;

    // Gestor de imágenes
    $nombreImagen = $_FILES["imagen"]["name"] ?? "";
    $rutaTemporal = $_FILES["imagen"]["tmp_name"] ?? "";
    $destino = "../../uploads/" . $nombreImagen;

    if (move_uploaded_file($rutaTemporal, $destino)) {
        $controller = new ProductoController();
        $controller->registrar($nombre, $precio, $nombreImagen, $cantidad);
        header("Location: index.php");
        exit();
    } else {
        $error = "Error al subir la imagen";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Producto</title>
</head>
<body>
    <h2>Registrar Nuevo Producto</h2>

    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <!-- Enctype es OBLIGATORIO para subir imágenes -->
    <form action="crear.php" method="POST" enctype="multipart/form-data">
        <div>
            <label>Nombre del Producto:</label>
            <input type="text" name="nombre" required>
        </div>
        <div>
            <label>Precio (S/):</label>
            <input type="number" step="0.01" name="precio" required>
        </div>
        <div>
            <label>Cantidad (Stock):</label>
            <input type="number" name="cantidad" required>
        </div>
        <div>
            <label>Imagen del Producto:</label>
            <input type="file" name="imagen" accept="image/*" required>
        </div>
        <br>
        <button type="submit">Guardar Producto</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>