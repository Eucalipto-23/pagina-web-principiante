<?php
header('Content-Type: application/json');
require_once '../config/database.php';

try {
    $conexion = (new Database())->conectar();

    // 1. Recibir datos enviados por POST
    $nombre   = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $dni      = $_POST['dni'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $total    = $_POST['total'] ?? 0;
    $detalles = json_decode($_POST['detalles'] ?? '[]', true);

    if (empty($nombre) || empty($apellido) || empty($dni) || empty($detalles)) {
        echo json_encode(['success' => false, 'mensaje' => 'Faltan datos requeridos.']);
        exit;
    }

    // Iniciar transacción SQL para asegurar la integridad de los datos
    $conexion->beginTransaction();

    // 2. Insertar Cliente
    $stmtCliente = $conexion->prepare("INSERT INTO clientes (nombre, apellido, DNI, telefono) VALUES (?, ?, ?, ?)");
    $stmtCliente->execute([$nombre, $apellido, $dni, $telefono]);
    $cliente_id = $conexion->lastInsertId();

    // 3. Insertar Compra
    $stmtCompra = $conexion->prepare("INSERT INTO compras (cliente_id, fecha, total) VALUES (?, NOW(), ?)");
    $stmtCompra->execute([$cliente_id, $total]);
    $compra_id = $conexion->lastInsertId();

    // Preparar consultas para Detalle de Compra y Descuento de Stock
    $stmtDetalle = $conexion->prepare("INSERT INTO detalle_compras (compra_id, producto_id, cantidad, precio, subtotal) VALUES (?, ?, ?, ?, ?)");
    $stmtStock   = $conexion->prepare("UPDATE productos SET cantidad = cantidad - ? WHERE id = ?");

    // 4. Insertar Detalle y Descontar Stock de cada producto
    foreach ($detalles as $item) {
        $subtotal = $item['precio'] * $item['cantidad'];
        
        // Guardar detalle
        $stmtDetalle->execute([
            $compra_id,
            $item['id'],
            $item['cantidad'],
            $item['precio'],
            $subtotal
        ]);

        // Restar la cantidad vendida del stock en la tabla productos
        $stmtStock->execute([
            $item['cantidad'],
            $item['id']
        ]);
    }

    // Confirmar todos los cambios
    $conexion->commit();

    echo json_encode(['success' => true]);

} catch (Exception $e) {
    // Si algo falla, revertimos la transacción
    if (isset($conexion) && $conexion->inTransaction()) {
        $conexion->rollBack();
    }
    echo json_encode(['success' => false, 'mensaje' => $e->getMessage()]);
}