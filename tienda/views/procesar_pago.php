<?php

$nombre = $_POST["nombre"];
$precio = $_POST["precio"];

$tarjeta = $_POST["tarjeta"];
$cvv = $_POST["cvv"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Pago</title>
    <link rel="stylesheet" href="css/estilos.css">

</head>
<body>

    <header>

        <h1>Resultado del Pago</h1>

    </header>
    <main>

        <form>
            <?php

            if (strlen($tarjeta) == 16 && strlen($cvv) == 3){

                echo "<h2> Pago aprobado</h2>";

                echo "<br>";

                echo "<p>Producto: $nombre</p>";

                echo "<p>Total pagado: S/ $precio</p>";

                echo "<br>";

                echo "<p>Gracias por su compra.</p>";

            } else {

                echo "<h2>Pago rechazado</h2>";

                echo "<br>";

                echo "<p>Los datos ingresados no son validos.</p>";
            }
            ?>
            <br>

            <a href="../index.php" class="btn">Volver a tienda</a>
        </form>
    </main>
    
</body>
</html>