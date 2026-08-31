<?php
require_once __DIR__ . "/../config/database.php";

class Producto
{
    private $conexion;

    public function __construct() {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    public function listar(){

        $sql = "SELECT * FROM productos ORDER BY id DESC";

        $stmt = $this->conexion->prepare($sql);
            $stmt->execute();

            return
            $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar($nombre, $precio, $imagen){

        $sql = "INSERT INTO productos (nombre, precio, imagen) 
        VALUES (:nombre, :precio, :imagen)";

        $stmt = $this->conexion->prepare($sql);

            return $stmt->execute([
                ":nombre" => $nombre,
                ":precio" => $precio,
                ":imagen" => $imagen
            ]);
    }
}