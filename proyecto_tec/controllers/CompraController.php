<?php
require_once __DIR__ . "/../config/database.php";

class CompraController
{
    private $conexion;

    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    public function procesarCompra($cliente_id, $carrito)
    {
        try {
            // 1. Iniciar Transacción
            $this->conexion->beginTransaction();

            $total = 0;
            foreach ($carrito as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }

            // 2. Insertar en tabla compras
            $sqlCompra = "INSERT INTO compras (cliente_id, fecha, total) VALUES (:cliente_id, NOW(), :total)";
            $stmtCompra = $this->conexion->prepare($sqlCompra);
            $stmtCompra->execute([
                ":cliente_id" => $cliente_id,
                ":total" => $total
            ]);

            $compra_id = $this->conexion->lastInsertId();

            // 3. Recorrer carrito: insertar detalles y descontar stock
            foreach ($carrito as $item) {
                $subtotal = $item['precio'] * $item['cantidad'];

                $sqlDetalle = "INSERT INTO detalle_compras (compra_id, producto_id, cantidad, precio, subtotal) 
                               VALUES (:compra_id, :producto_id, :cantidad, :precio, :subtotal)";
                $stmtDetalle = $this->conexion->prepare($sqlDetalle);
                $stmtDetalle->execute([
                    ":compra_id" => $compra_id,
                    ":producto_id" => $item['id'],
                    ":cantidad" => $item['cantidad'],
                    ":precio" => $item['precio'],
                    ":subtotal" => $subtotal
                ]);

                $sqlStock = "UPDATE productos SET cantidad = cantidad - :cantidad WHERE id = :producto_id";
                $stmtStock = $this->conexion->prepare($sqlStock);
                $stmtStock->execute([
                    ":cantidad" => $item['cantidad'],
                    ":producto_id" => $item['id']
                ]);
            }

            // 4. Confirmar cambios
            $this->conexion->commit();
            return ["success" => true, "compra_id" => $compra_id];

        } catch (Exception $e) {
            // 5. Cancelar cambios si ocurre error
            $this->conexion->rollBack();
            return ["success" => false, "error" => $e->getMessage()];
        }
    }
}