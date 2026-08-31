<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pasarela de Pago - TechMarket</title>
    <link rel="stylesheet" href="../../public/css/estilos.css?v=2">
</head>
<body>

    <header>
        <h1>TechMarket Online</h1>
       <nav>
        <a href="../../index.php">Inicio / Tienda</a>
        <a href="../Producto/index.php">Admin Productos</a>
        <a href="../carrito/index.php">🛒 Ver Carrito</a>
    </nav>
    </header>

    <main>
        <h2>Pasarela de Pago</h2>

        <form id="form-pago">
            <h3>1. Datos del Cliente</h3>
            <div>
                <label>Nombre:</label>
                <input type="text" id="nombre" required placeholder="Ej. Juan">
            </div>

            <div>
                <label>Apellido:</label>
                <input type="text" id="apellido" required placeholder="Ej. Pérez">
            </div>

            <div>
                <label>DNI:</label>
                <input type="text" id="dni" maxlength="8" required placeholder="8 dígitos">
            </div>

            <div>
                <label>Teléfono:</label>
                <input type="text" id="telefono" placeholder="Ej. 987654321">
            </div>

            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #ccc;">

            <h3>2. Información de Pago </h3>
            <div>
                <label>Número de Tarjeta:</label>
                <input type="text" maxlength="16" placeholder="4557 0000 0000 0000" required>
            </div>

            <div style="display: flex; gap: 10px;">
                <div style="flex: 1;">
                    <label>Vencimiento:</label>
                    <input type="text" placeholder="MM/AA" maxlength="5" required>
                </div>
                <div style="flex: 1;">
                    <label>CVV:</label>
                    <input type="password" maxlength="3" placeholder="123" required>
                </div>
            </div>

            <div style="margin-top: 15px;">
                <p><strong>Total a Pagar: S/ <span id="monto-total">0.00</span></strong></p>
            </div>

            <button type="submit">Procesar Pago</button>
        </form>
    </main>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
        if (carrito.length === 0) {
            alert("El carrito está vacío.");
            window.location.href = "../carrito/index.php";
            return;
        }

        let total = 0;
        carrito.forEach(item => {
            total += item.precio * item.cantidad;
        });
        document.getElementById("monto-total").innerText = total.toFixed(2);
    });

    document.getElementById("form-pago").addEventListener("submit", function(e) {
        e.preventDefault();

        let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
        let total = document.getElementById("monto-total").innerText;

        // Solo enviamos los datos correspondientes a tu base de datos
        let datos = new FormData();
        datos.append("nombre", document.getElementById("nombre").value);
        datos.append("apellido", document.getElementById("apellido").value);
        datos.append("dni", document.getElementById("dni").value);
        datos.append("telefono", document.getElementById("telefono").value);
        datos.append("total", total);
        datos.append("detalles", JSON.stringify(carrito));

        fetch("../../ajax/compra.php", {
            method: "POST",
            body: datos
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                alert("¡Pago procesado correctamente! La transacción ha sido registrada.");
                localStorage.removeItem("carrito");
                window.location.href = "../../index.php";
            } else {
                alert("Error al registrar la compra: " + res.mensaje);
            }
        })
        .catch(err => {
            console.error(err);
            alert("Ocurrió un error en la conexión.");
        });
    });
    </script>
</body>
</html>