<?php

require_once __DIR__ . "/../models/Producto.php";

class ProductoController{

    private $producto;

    public function __construct(){

        $this->producto = new Producto();
    }

    public function listar(){
        return
        $this->producto->listar();
    }

    public function registrar($nombre, $precio, $imagen){
        return
        $this->producto->registrar(
            $nombre,
            $precio,
            $imagen
        );
    }
}