// Cargar productos en la vista principal
function cargarProductos() {
    let datos = new FormData();
    datos.append("accion", "listar");

    fetch("ajax/productos.php", {
        method: "POST",
        body: datos
    })
    .then(res => res.json())
    .then(respuesta => {
        if (respuesta.success) {
            let html = "";
            respuesta.data.forEach(p => {
                html += `
                    <div class="producto-card">
                        <img src="uploads/${p.imagen}" alt="${p.nombre}">
                        <h3>${p.nombre}</h3>
                        <p>Precio: S/ ${p.precio}</p>
                        <p>Stock: ${p.cantidad}</p>
                        <button onclick="eliminarProducto(${p.id})">Eliminar</button>
                    </div>
                `;
            });
            let contenedor = document.getElementById("productos-lista");
            if (contenedor) contenedor.innerHTML = html;
        }
    })
    .catch(err => console.error("Error al cargar productos:", err));
}

// Eliminar producto mediante AJAX
function eliminarProducto(id) {
    if (confirm("¿Deseas eliminar este producto?")) {
        let datos = new FormData();
        datos.append("accion", "eliminar");
        datos.append("id", id);

        fetch("ajax/productos.php", {
            method: "POST",
            body: datos
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                alert("Producto eliminado con éxito");
                cargarProductos();
            }
        });
    }
}