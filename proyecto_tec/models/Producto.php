<?php
require_once __DIR__ . "/../config/database.php";

class Producto
{
    private $conexion;

    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    public function listar()
    {
        $sql = "SELECT * FROM productos ORDER BY id DESC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar($nombre, $precio, $imagen, $cantidad)
    {
        $sql = "INSERT INTO productos (nombre, precio, imagen, cantidad)
                VALUES (:nombre, :precio, :imagen, :cantidad)";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":nombre" => $nombre,
            ":precio" => $precio,
            ":imagen" => $imagen,
            ":cantidad" => $cantidad
        ]);
    }

    public function obtener($id)
    {
        $sql = "SELECT * FROM productos WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $precio, $imagen, $cantidad)
    {
        $sql = "UPDATE productos 
                SET nombre = :nombre,
                    precio = :precio,
                    imagen = :imagen,
                    cantidad = :cantidad
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":nombre" => $nombre,
            ":precio" => $precio,
            ":imagen" => $imagen,
            ":cantidad" => $cantidad,
            ":id" => $id
        ]);
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM productos WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id" => $id
        ]);
    }
}