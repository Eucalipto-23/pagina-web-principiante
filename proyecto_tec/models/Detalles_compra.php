<?php

require_once __DIR__ . "/../config/database.php";

class DetalleCompra
{
    private $conexion;

    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    public function listar()
    {
        $sql = "SELECT * FROM detalle_compras ORDER BY id DESC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar($compra_id, $producto_id, $cantidad, $precio, $subtotal)
    {
        $sql = "INSERT INTO detalle_compras
                (compra_id, producto_id, cantidad, precio, subtotal)
                VALUES
                (:compra_id, :producto_id, :cantidad, :precio, :subtotal)";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":compra_id" => $compra_id,
            ":producto_id" => $producto_id,
            ":cantidad" => $cantidad,
            ":precio" => $precio,
            ":subtotal" => $subtotal
        ]);
    }

    public function obtener($id)
    {
        $sql = "SELECT * FROM detalle_compras WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $compra_id, $producto_id, $cantidad, $precio, $subtotal)
    {
        $sql = "UPDATE detalle_compras
                SET compra_id = :compra_id,
                    producto_id = :producto_id,
                    cantidad = :cantidad,
                    precio = :precio,
                    subtotal = :subtotal
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":compra_id" => $compra_id,
            ":producto_id" => $producto_id,
            ":cantidad" => $cantidad,
            ":precio" => $precio,
            ":subtotal" => $subtotal,
            ":id" => $id
        ]);
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM detalle_compras WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id" => $id
        ]);
    }
}