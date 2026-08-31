<?php

header('Content-Type: application/json');
require_once __DIR__ . "/../controllers/DetalleCompraController.php";

$controller = new DetalleCompraController();

$accion = $_POST["accion"] ?? "";

switch ($accion) {

    case "listar":

        $detalles = $controller->listar();

        echo json_encode([
            "success" => true,
            "data" => $detalles
        ]);

        break;


    case "registrar":

        $compra_id = $_POST["compra_id"] ?? 0;
        $producto_id = $_POST["producto_id"] ?? 0;
        $cantidad = $_POST["cantidad"] ?? 0;
        $precio = $_POST["precio"] ?? 0;
        $subtotal = $_POST["subtotal"] ?? 0;

        $resultado = $controller->registrar(
            $compra_id,
            $producto_id,
            $cantidad,
            $precio,
            $subtotal
        );

        echo json_encode([
            "success" => $resultado
        ]);

        break;


    case "obtener":

        $id = $_POST["id"] ?? 0;

        $detalle = $controller->obtener($id);

        echo json_encode([
            "success" => true,
            "data" => $detalle
        ]);

        break;


    case "actualizar":

        $id = $_POST["id"] ?? 0;
        $compra_id = $_POST["compra_id"] ?? 0;
        $producto_id = $_POST["producto_id"] ?? 0;
        $cantidad = $_POST["cantidad"] ?? 0;
        $precio = $_POST["precio"] ?? 0;
        $subtotal = $_POST["subtotal"] ?? 0;

        $resultado = $controller->actualizar(
            $id,
            $compra_id,
            $producto_id,
            $cantidad,
            $precio,
            $subtotal
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