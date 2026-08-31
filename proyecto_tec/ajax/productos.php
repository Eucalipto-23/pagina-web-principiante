<?php

header('Content-Type: application/json');
require_once __DIR__ . "/../controllers/ProductoController.php";

$controller = new ProductoController();

$accion = $_POST["accion"] ?? "";

switch ($accion) {

    case "listar":

        $productos = $controller->listar();

        echo json_encode([
            "success" => true,
            "data" => $productos
        ]);

        break;

        
    case "registrar":

        $nombre = $_POST["nombre"] ?? "";
        $precio = $_POST["precio"] ?? 0;
        $imagen = $_POST["imagen"] ?? "";
        $cantidad = $_POST["cantidad"] ?? 0;

        $resultado = $controller->registrar(
            $nombre,
            $precio,
            $imagen,
            $cantidad
        );

        echo json_encode([
            "success" => $resultado
        ]);

        break;


    case "obtener":

        $id = $_POST["id"] ?? 0;

        $producto = $controller->obtener($id);

        echo json_encode([
            "success" => true,
            "data" => $producto
        ]);

        break;


    case "actualizar":

        $id = $_POST["id"] ?? 0;
        $nombre = $_POST["nombre"] ?? "";
        $precio = $_POST["precio"] ?? 0;
        $imagen = $_POST["imagen"] ?? "";
        $cantidad = $_POST["cantidad"] ?? 0;

        $resultado = $controller->actualizar(
            $id,
            $nombre,
            $precio,
            $imagen,
            $cantidad
        );

        echo json_encode([
            "success" => $resultado
        ]);

        break;


    case "eliminar":

        $id = $_POST["id"] ?? 0;

        $resultado = $controller->eliminar($id);

        echo json_encode([
            "success" => $resultado
        ]);

        break;


    default:

        echo json_encode([
            "success" => false,
            "mensaje" => "Acción no válida"
        ]);

        break;
}