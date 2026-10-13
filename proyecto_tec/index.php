<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechMarket Online - Tienda</title>
    <!-- CSS con versión para forzar actualización de caché -->
    <link rel="stylesheet" href="public/css/estilos.css?v=2">
</head>
<body>

    <header>
        <h1>TechMarket Online</h1>
        <nav>
    <a href="index.php">Inicio / Tienda</a>
    <a href="productos/Producto/index.php">Admin Productos</a>
    <a href="productos/carrito/index.php">Ver Carrito</a>
</nav>
    </header>

    <main>
        <h2>Catálogo de Productos</h2>
        <div id="contenedor-productos" class="grid-productos">
            <p>Cargando productos...</p>
        </div>
    </main>

    <script>
    document.addEventListener("DOMContentLoaded", cargarCatalogo);

    function cargarCatalogo() {
        let datos = new FormData();
        datos.append("accion", "listar");

        fetch("ajax/productos.php", {
            method: "POST",
            body: datos
        })
        .then(res => res.json())
        .then(res => {
            let contenedor = document.getElementById("contenedor-productos");
            
            if (res.success && res.data.length > 0) {
                let html = "";
                
                res.data.forEach(p => {
                    let rutaImagen = (p.imagen && p.imagen.trim() !== "") 
                        ? `uploads/${p.imagen}` 
                        : 'https://via.placeholder.com/150?text=Sin+Imagen';

                    html += `
                        <div class="card-producto">
                            <img src="${rutaImagen}" alt="${p.nombre}">
                            <h3>${p.nombre}</h3>
                            <p><strong>Precio:</strong> S/ ${parseFloat(p.precio).toFixed(2)}</p>
                            <p><strong>Stock:</strong> ${p.cantidad}</p>
                            <button onclick="agregarAlCarrito(${p.id}, '${p.nombre}', ${p.precio})">
                                Agregar al Carrito
                            </button>
                        </div>
                    `;
                });
                
                contenedor.innerHTML = html;
            } else {
                contenedor.innerHTML = "<p>No hay productos disponibles por el momento.</p>";
            }
        })
        .catch(err => {
            console.error("Error al cargar productos:", err);
            document.getElementById("contenedor-productos").innerHTML = "<p>Error al conectar con la base de datos.</p>";
        });
    }

    function agregarAlCarrito(id, nombre, precio) {
        let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
        
        let existe = carrito.find(item => item.id === id);
        if (existe) {
            existe.cantidad += 1;
        } else {
            carrito.push({
                id: id,
                nombre: nombre,
                precio: parseFloat(precio),
                cantidad: 1
            });
        }

        localStorage.setItem("carrito", JSON.stringify(carrito));
        alert(`"${nombre}" fue agregado al carrito.`);
    }
    </script>
</body>
</html>