<?php
require_once __DIR__ . "/../config/database.php";

class Cliente
{
    private $conexion;

    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    public function listar()
    {
        $sql = "SELECT * FROM clientes ORDER BY id DESC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar($nombre, $apellido, $DNI, $telefono)
    {
        $sql = "INSERT INTO clientes (nombre, apellido, DNI, telefono)
                VALUES (:nombre, :apellido, :DNI, :telefono)";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":nombre" => $nombre,
            ":apellido" => $apellido,
            ":DNI" => $DNI,
            ":telefono" => $telefono
        ]);
    }

    public function obtener($id)
    {
        $sql = "SELECT * FROM clientes WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $apellido, $DNI, $telefono)
    {
        $sql = "UPDATE clientes
                SET nombre = :nombre,
                    apellido = :apellido,
                    DNI = :DNI,
                    telefono = :telefono
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":nombre" => $nombre,
            ":apellido" => $apellido,
            ":DNI" => $DNI,
            ":telefono" => $telefono,
            ":id" => $id
        ]);
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM clientes WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id" => $id
        ]);
    }
}