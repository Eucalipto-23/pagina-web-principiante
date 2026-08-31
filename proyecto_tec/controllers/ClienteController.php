<?php

require_once __DIR__ . "/../models/Cliente.php";

class ClienteController
{
    private $cliente;

    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    public function listar()
    {
        return $this->cliente->listar();
    }

    public function registrar($nombre, $apellido, $DNI, $telefono)
    {
        return $this->cliente->registrar(
            $nombre,
            $apellido,
            $DNI,
            $telefono
        );
    }

    public function obtener($id)
    {
        return $this->cliente->obtener($id);
    }

    public function actualizar($id, $nombre, $apellido, $DNI, $telefono)
    {
        return $this->cliente->actualizar(
            $id,
            $nombre,
            $apellido,
            $DNI,
            $telefono
        );
    }

    public function eliminar($id)
    {
        return $this->cliente->eliminar($id);
    }
}