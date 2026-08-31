<?php

require_once "../controllers/ProductoController.php";

$nombre = $_POST["nombre"];
$precio = $_POST["precio"];

$imagen = $_FILES["imagen"];

$nombreImagen =
    time() . "_" . basename($imagen["name"]);

$ruta = "../uploads/" . $nombreImagen;

move_uploaded_file(
    $imagen["tmp_name"],
    $ruta
);

$controller = new ProductoController();

$controller->registrar(
    $nombre,
    $precio,
    $nombreImagen
);

header("Location: ../index.php");

exit;