<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
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
        <h2>Carrito de Compras</h2>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio Unid.</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="tabla-carrito">
                <!-- Se renderiza desde localStorage -->
            </tbody>
        </table>

        <div style="margin-top: 15px; text-align: right; max-width: 100%;">
            <h3>Total: S/ <span id="total-carrito">0.00</span></h3>
            <button onclick="vaciarCarrito()" class="btn-danger">Vaciar Carrito</button>
            <a href="../pago/index.php"><button style="background-color: #2980b9;">Procesar Pago</button></a>
        </div>
    </main>

    <script>
    document.addEventListener("DOMContentLoaded", renderizarCarrito);

    function renderizarCarrito() {
        let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
        let tbody = document.getElementById("tabla-carrito");
        let totalSpan = document.getElementById("total-carrito");

        if (carrito.length === 0) {
            tbody.innerHTML = "<tr><td colspan='5'>El carrito está vacío.</td></tr>";
            totalSpan.innerText = "0.00";
            return;
        }

        let html = "";
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
                        <button class="btn-danger" onclick="eliminarItem(${index})">Quitar</button>
                    </td>
                </tr>
            `;
        });

        tbody.innerHTML = html;
        totalSpan.innerText = totalGeneral.toFixed(2);
    }

    function eliminarItem(index) {
        let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
        carrito.splice(index, 1);
        localStorage.setItem("carrito", JSON.stringify(carrito));
        renderizarCarrito();
    }

    function vaciarCarrito() {
        if (confirm("¿Deseas vaciar todo el carrito?")) {
            localStorage.removeItem("carrito");
            renderizarCarrito();
        }
    }
    </script>
</body>
</html>