<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <!-- Ruta relativa para subir 2 niveles hasta la carpeta public/ -->
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
        <h2>Gestión de Productos</h2>
        <p><a href="crear.php">+ Registrar Nuevo Producto</a></p>

        <table>
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tabla-productos">
                <tr><td colspan="5">Cargando productos...</td></tr>
            </tbody>
        </table>
    </main>

    <script>
    document.addEventListener("DOMContentLoaded", cargarProductos);

    function cargarProductos() {
        let datos = new FormData();
        datos.append("accion", "listar");

        // Subimos 2 niveles para llegar a la carpeta ajax/
        fetch("../../ajax/productos.php", {
            method: "POST",
            body: datos
        })
        .then(res => res.json())
        .then(res => {
            let tbody = document.getElementById("tabla-productos");
            if (res.success && res.data.length > 0) {
                let html = "";
                res.data.forEach(p => {
                    // Validamos la imagen para subir los 2 niveles hasta la raíz uploads/
                    let rutaImagen = (p.imagen && p.imagen.trim() !== "") 
                        ? `../../uploads/${p.imagen}` 
                        : 'https://via.placeholder.com/50?text=Sin+Foto';

                    html += `
                        <tr>
                            <td>
                                <img src="${rutaImagen}" alt="${p.nombre}" style="width: 40px; height: 40px; object-fit: contain;">
                            </td>
                            <td>${p.nombre}</td>
                            <td>S/ ${parseFloat(p.precio).toFixed(2)}</td>
                            <td>${p.cantidad}</td>
                            <td>
                                <a href="editar.php?id=${p.id}">Editar</a> | 
                                <button class="btn-danger" onclick="eliminarProducto(${p.id})">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
                tbody.innerHTML = html;
            } else {
                tbody.innerHTML = "<tr><td colspan='5'>No hay productos registrados.</td></tr>";
            }
        })
        .catch(err => {
            console.error(err);
            document.getElementById("tabla-productos").innerHTML = "<tr><td colspan='5'>Error al cargar los productos.</td></tr>";
        });
    }

    function eliminarProducto(id) {
        if (!confirm("¿Estás seguro de eliminar este producto?")) return;

        let datos = new FormData();
        datos.append("accion", "eliminar");
        datos.append("id", id);

        fetch("../../ajax/productos.php", {
            method: "POST",
            body: datos
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                alert("Producto eliminado correctamente.");
                cargarProductos();
            } else {
                alert("Error al eliminar el producto.");
            }
        });
    }
    </script>
</body>
</html>