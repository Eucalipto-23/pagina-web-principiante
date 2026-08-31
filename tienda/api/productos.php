<?php

require_once __DIR__ . "/../models/Producto.php";

$producto = new Producto();

$datos = $producto->listar();

header("Content-Type: application/json; charset=UTF-8");

echo json_encode($datos);