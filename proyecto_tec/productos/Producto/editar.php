<?php
require_once __DIR__ . "/../../controllers/ProductoController.php";

$controller = new ProductoController();
$id = $_GET["id"] ?? 0;
$producto = $controller->obtener($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];
    
    // Si sube una imagen nueva la actualiza, si no mantiene la actual
    if (!empty($_FILES["imagen"]["name"])) {
        $imagen = $_FILES["imagen"]["name"];
        move_uploaded_file($_FILES["imagen"]["tmp_name"], "../../uploads/" . $imagen);
    } else {
        $imagen = $_POST["imagen_actual"];
    }

    $controller->actualizar($id, $nombre, $precio, $imagen, $cantidad);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h2>Editar Producto</h2>

    <form action="editar.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $producto['id'] ?>">
        <input type="hidden" name="imagen_actual" value="<?= $producto['imagen'] ?>">

        <div>
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" required>
        </div>
        <div>
            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" required>
        </div>
        <div>
            <label>Cantidad:</label>
            <input type="number" name="cantidad" value="<?= $producto['cantidad'] ?>" required>
        </div>
        <div>
            <label>Imagen Actual:</label><br>
            <img src="../../uploads/<?= $producto['imagen'] ?>" width="80"><br>
            <label>Cambiar Imagen (Opcional):</label>
            <input type="file" name="imagen" accept="image/*">
        </div>
        <br>
        <button type="submit">Actualizar Producto</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>