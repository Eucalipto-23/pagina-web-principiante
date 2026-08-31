<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes - TechMarket</title>
    <link rel="stylesheet" href="../../public/css/estilos.css">
</head>
<body>
    <h2>Gestión de Clientes</h2>
    <a href="crear.php"> + Registrar Nuevo Cliente</a>
    <br><br>

    <div id="clientes-lista">
        <!-- Se llena dinámicamente con AJAX -->
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", cargarClientes);

    function cargarClientes() {
        let datos = new FormData();
        datos.append("accion", "listar");

        fetch("../../ajax/clientes.php", {
            method: "POST",
            body: datos
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                let html = "<table border='1'><tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>DNI</th><th>Teléfono</th><th>Acciones</th></tr>";
                res.data.forEach(c => {
                    html += `
                        <tr>
                            <td>${c.id}</td>
                            <td>${c.nombre}</td>
                            <td>${c.apellido}</td>
                            <td>${c.DNI}</td>
                            <td>${c.telefono}</td>
                            <td>
                                <a href="editar.php?id=${c.id}">Editar</a> | 
                                <button onclick="eliminarCliente(${c.id})">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
                html += "</table>";
                document.getElementById("clientes-lista").innerHTML = html;
            }
        });
    }

    function eliminarCliente(id) {
        if (confirm("¿Deseas eliminar a este cliente?")) {
            let datos = new FormData();
            datos.append("accion", "eliminar");
            datos.append("id", id);

            fetch("../../ajax/clientes.php", {
                method: "POST",
                body: datos
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    alert("Cliente eliminado con éxito");
                    cargarClientes();
                }
            });
        }
    }
    </script>
</body>
</html>