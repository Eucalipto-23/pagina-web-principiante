<?php
require_once __DIR__ . "/../../controllers/ClienteController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"] ?? "";
    $apellido = $_POST["apellido"] ?? "";
    $dni = $_POST["dni"] ?? "";
    $telefono = $_POST["telefono"] ?? "";

    $controller = new ClienteController();
    $controller->registrar($nombre, $apellido, $dni, $telefono);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Cliente</title>
</head>
<body>
    <h2>Registrar Nuevo Cliente</h2>

    <form action="crear.php" method="POST">
        <div>
            <label>Nombre:</label>
            <input type="text" name="nombre" required>
        </div>
        <div>
            <label>Apellido:</label>
            <input type="text" name="apellido" required>
        </div>
        <div>
            <label>DNI:</label>
            <input type="text" name="dni" maxlength="8" required>
        </div>
        <div>
            <label>Teléfono:</label>
            <input type="text" name="telefono" required>
        </div>
        <br>
        <button type="submit">Guardar Cliente</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>