<?php

header('Content-Type: application/json');
require_once __DIR__ . "/../controllers/ClienteController.php";

$controller = new ClienteController();

$accion = $_POST["accion"] ?? "";

switch ($accion) {

    case "listar":

        $clientes = $controller->listar();

        echo json_encode([
            "success" => true,
            "data" => $clientes
        ]);

        break;


    case "registrar":

        $nombre = $_POST["nombre"] ?? "";
        $apellido = $_POST["apellido"] ?? "";
        $DNI = $_POST["DNI"] ?? "";
        $telefono = $_POST["telefono"] ?? "";

        $resultado = $controller->registrar(
            $nombre,
            $apellido,
            $DNI,
            $telefono
        );

        echo json_encode([
            "success" => $resultado
        ]);

        break;


    case "obtener":

        $id = $_POST["id"] ?? 0;

        $cliente = $controller->obtener($id);

        echo json_encode([
            "success" => true,
            "data" => $cliente
        ]);

        break;


    case "actualizar":

        $id = $_POST["id"] ?? 0;
        $nombre = $_POST["nombre"] ?? "";
        $apellido = $_POST["apellido"] ?? "";
        $DNI = $_POST["DNI"] ?? "";
        $telefono = $_POST["telefono"] ?? "";

        $resultado = $controller->actualizar(
            $id,
            $nombre,
            $apellido,
            $DNI,
            $telefono
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