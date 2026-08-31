<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pasarela de Pago - TechMarket</title>
    <link rel="stylesheet" href="../../public/css/estilos.css">
</head>
<body>
    <h2>Pasarela de Pago</h2>

    <form id="formPago">
        <!-- Simulamos el ID del cliente registrado -->
        <input type="hidden" id="cliente_id" value="1">

        <div>
            <label>Número de Tarjeta (Simulación):</label>
            <input type="text" id="tarjeta" required maxlength="16" placeholder="1234 5678 9101 1121">
        </div>

        <button type="submit">Procesar Pago</button>
    </form>

    <script>
    document.getElementById("formPago").addEventListener("submit", function(e) {
        e.preventDefault();

        // Se obtiene el carrito guardado previamente en el navegador
        let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
        let clienteId = document.getElementById("cliente_id").value;

        if (carrito.length === 0) {
            alert("El carrito está vacío");
            return;
        }

        fetch("../../ajax/compra.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                cliente_id: clienteId,
                carrito: carrito
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert("¡Compra procesada con éxito! Registro Nº: " + data.compra_id);
                localStorage.removeItem("carrito");
                window.location.href = "../index.php";
            } else {
                alert("Error al procesar el pago: " + data.error);
            }
        })
        .catch(err => console.error("Error en la solicitud:", err));
    });
    </script>
</body>
</html>