<?php
require_once __DIR__ . "/../../controllers/ClienteController.php";

$controller = new ClienteController();
$id = $_GET["id"] ?? 0;
$cliente = $controller->obtener($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $telefono = $_POST["telefono"];

    $controller->actualizar($id, $nombre, $apellido, $dni, $telefono);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>
<body>
    <h2>Editar Cliente</h2>

    <form action="editar.php" method="POST">
        <input type="hidden" name="id" value="<?= $cliente['id'] ?>">

        <div>
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?= $cliente['nombre'] ?>" required>
        </div>
        <div>
            <label>Apellido:</label>
            <input type="text" name="apellido" value="<?= $cliente['apellido'] ?>" required>
        </div>
        <div>
            <label>DNI:</label>
            <input type="text" name="dni" maxlength="8" value="<?= $cliente['DNI'] ?>" required>
        </div>
        <div>
            <label>Teléfono:</label>
            <input type="text" name="telefono" value="<?= $cliente['telefono'] ?>" required>
        </div>
        <br>
        <button type="submit">Actualizar Cliente</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>