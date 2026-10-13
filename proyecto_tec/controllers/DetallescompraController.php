<?php

require_once __DIR__ . "/../models/DetalleCompra.php";

class DetalleCompraController
{
    private $detalleCompra;

    public function __construct()
    {
        $this->detalleCompra = new DetalleCompra();
    }

    public function listar()
    {
        return $this->detalleCompra->listar();
    }

    public function registrar($compra_id, $producto_id, $cantidad, $precio, $subtotal)
    {
        return $this->detalleCompra->registrar(
            $compra_id,
            $producto_id,
            $cantidad,
            $precio,
            $subtotal
        );
    }

    public function obtener($id)
    {
        return $this->detalleCompra->obtener($id);
    }

    public function actualizar($id, $compra_id, $producto_id, $cantidad, $precio, $subtotal)
    {
        return $this->detalleCompra->actualizar(
            $id,
            $compra_id,
            $producto_id,
            $cantidad,
            $precio,
            $subtotal
        );
    }

    public function eliminar($id)
    {
        return $this->detalleCompra->eliminar($id);
    }
}