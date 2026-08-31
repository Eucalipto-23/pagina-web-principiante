<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras - TechMarket</title>
    <link rel="stylesheet" href="../../public/css/estilos.css">
</head>
<body>
    <h2>Tu Carrito de Compras</h2>
    <a href="../Producto/index.php">← Volver al Catálogo</a>
    <br><br>

    <div id="contenido-carrito">
        <!-- Se genera dinámicamente con JavaScript -->
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", mostrarCarrito);

    function mostrarCarrito() {
        // Obtener productos guardados en el almacenamiento local
        let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
        let contenedor = document.getElementById("contenido-carrito");

        if (carrito.length === 0) {
            contenedor.innerHTML = "<p>El carrito está vacío.</p>";
            return;
        }

        let html = `
            <table border="1">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
        `;

        let totalGeneral = 0;

        carrito.forEach((item, index) => {
            let subtotal = item.precio * item.cantidad;
            totalGeneral += subtotal;

            html += `
                <tr>
                    <td>${item.nombre}</td>
                    <td>S/ ${parseFloat(item.precio).toFixed(2)}</td>
                    <td>${item.cantidad}</td>
                    <td>S/ ${subtotal.toFixed(2)}</td>
                    <td>
                        <button onclick="eliminarDelCarrito(${index})">Quitar</button>
                    </td>
                </tr>
            `;
        });

        html += `
                </tbody>
            </table>
            <h3>Total a Pagar: S/ ${totalGeneral.toFixed(2)}</h3>
            <br>
            <button onclick="vaciarCarrito()">Vaciar Carrito</button>
            <a href="../pago/index.php"><button>Proceder al Pago →</button></a>
        `;

        contenedor.innerHTML = html;
    }

    function eliminarDelCarrito(index) {
        let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
        carrito.splice(index, 1); // Elimina el elemento en ese índice
        localStorage.setItem("carrito", JSON.stringify(carrito));
        mostrarCarrito(); // Recarga la vista del carrito
    }

    function vaciarCarrito() {
        if (confirm("¿Deseas vaciar todo el carrito?")) {
            localStorage.removeItem("carrito");
            mostrarCarrito();
        }
    }
    </script>
</body>
</html>