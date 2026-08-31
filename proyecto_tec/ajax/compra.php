<?php
header('Content-Type: application/json');
require_once __DIR__ . "/../controllers/CompraController.php";

$datos = json_decode(file_get_contents("php://input"), true);

$cliente_id = $datos["cliente_id"] ?? null;
$carrito = $datos["carrito"] ?? [];

if ($cliente_id && !empty($carrito)) {
    $controller = new CompraController();
    $respuesta = $controller->procesarCompra($cliente_id, $carrito);
    echo json_encode($respuesta);
} else {
    echo json_encode(["success" => false, "error" => "Datos o carrito incompletos"]);
}