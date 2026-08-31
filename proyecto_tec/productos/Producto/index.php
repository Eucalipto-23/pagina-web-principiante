<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos - TechMarket</title>
    <link rel="stylesheet" href="../../public/css/estilos.css">
</head>
<body>
    <h2>Gestión de Productos</h2>
    <a href="crear.php"> + Registrar Nuevo Producto</a>
    <br><br>

    <div id="productos-lista">
        <!-- Se llena automáticamente con JS -->
    </div>

    <script>
    // Cargar la lista al abrir la página
    document.addEventListener("DOMContentLoaded", cargarProductos);

    function cargarProductos() {
        let datos = new FormData();
        datos.append("accion", "listar");

        fetch("../../ajax/productos.php", {
            method: "POST",
            body: datos
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                let html = "<table border='1'><tr><th>Imagen</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Acciones</th></tr>";
                res.data.forEach(p => {
                    html += `
                        <tr>
                            <td><img src="../../uploads/${p.imagen}" width="50"></td>
                            <td>${p.nombre}</td>
                            <td>S/ ${p.precio}</td>
                            <td>${p.cantidad}</td>
                            <td>
                                <a href="editar.php?id=${p.id}">Editar</a> | 
                                <button onclick="eliminarProducto(${p.id})">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
                html += "</table>";
                document.getElementById("productos-lista").innerHTML = html;
            }
        });
    }

    function eliminarProducto(id) {
        if (confirm("¿Estás seguro de eliminar este producto?")) {
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
                    alert("Producto eliminado");
                    cargarProductos();
                }
            });
        }
    }
    </script>
</body>
</html>