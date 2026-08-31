<?php

$nombre = $_GET["nombre"] ?? "";
$precio = $_GET["precio"] ?? 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasarela de pagos</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<header>

    <h1>Pasarela de pago</h1>

</header>

<main>

    <form action="procesar_pago.php" method="POST">

        <h2>Resumen de compra</h2>

        <p>Producto: <strong><?=htmlspecialchars($nombre) ?></strong> </p>

        <br>

        <p>Total:<strong> S/ <?=htmlspecialchars($precio) ?></strong> </p>

        <br>

        <input type="hidden" name="nombre" value="<?=htmlspecialchars($nombre) ?>">

        <input type="hidden" name="precio" value="<?=htmlspecialchars($precio) ?>">

        <label>Numero de tarjeta</label>

        <input type="text" name="tarjeta" maxlength="16" 
        placeholder="1111222233334444" required>

        <label>CVV</label>

        <input type="password" name="cvv" maxlength="3" placeholder="123" required>

        <button type="submit">Pagar</button>
    </form>
</main>
    
</body>
</html>