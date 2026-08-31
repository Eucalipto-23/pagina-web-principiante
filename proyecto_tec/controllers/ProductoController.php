<?php

require_once __DIR__ . "/../models/Producto.php";

class ProductoController
{
    private $producto;

    public function __construct()
    {
        $this->producto = new Producto();
    }

    public function listar()
    {
        return $this->producto->listar();
    }

    public function obtener($id)
    {
        return $this->producto->obtener($id);
    }

    public function registrar($nombre, $precio, $imagen, $cantidad)
    {
        return $this->producto->registrar(
            $nombre,
            $precio,
            $imagen,
            $cantidad
        );
    }

    public function actualizar($id, $nombre, $precio, $imagen, $cantidad)
    {
        return $this->producto->actualizar(
            $id,
            $nombre,
            $precio,
            $imagen,
            $cantidad
        );
    }

    public function eliminar($id)
    {
        return $this->producto->eliminar($id);
    }
}