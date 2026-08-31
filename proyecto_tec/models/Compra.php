<?php

require_once __DIR__ . "/../config/database.php";

class Compra
{
    private $conexion;

    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    public function listar()
    {
        $sql = "SELECT * FROM compras ORDER BY id DESC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar($cliente_id, $total)
    {
        $sql = "INSERT INTO compras (cliente_id, total)
                VALUES (:cliente_id, :total)";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":cliente_id" => $cliente_id,
            ":total" => $total
        ]);
    }

    public function obtener($id)
    {
        $sql = "SELECT * FROM compras WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $cliente_id, $total)
    {
        $sql = "UPDATE compras
                SET cliente_id = :cliente_id,
                    total = :total
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":cliente_id" => $cliente_id,
            ":total" => $total,
            ":id" => $id
        ]);
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM compras WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id" => $id
        ]);
    }
}