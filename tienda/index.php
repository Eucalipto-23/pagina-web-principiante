<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi tiendita</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
   
<header>

    <h1>Mi tiendita</h1>

    <nav>

        <a href="index.php">Inicio</a>

        <a href="views/registrar.php">
            Registrar producto
        </a>

    </nav>

</header>

<main>

    <h2>Productos disponibles</h2>

    <div id="productos" class="productos">

    </div>

</main>

<footer>

    <p> © TODOS LOS DERECHOS RESERVADOS - mitienda.com 2026</p>

</footer>

<script>

fetch("api/productos.php")

    .then(response => response.json())

    .then(productos => {

        let contenido = "";

        productos.forEach(producto => {

            contenido += `

                <div class="producto">

                    <img
                        src="uploads/${producto.imagen}"
                        alt="${producto.nombre}"
                    >

                    <h3>
                        ${producto.nombre}
                    </h3>

                    <p class="precio">
                        S/ ${producto.precio}
                    </p>

                    <a
                        class="btn"
                        href="views/pago.php?id=${producto.id}
                        &nombre=${encodeURIComponent(producto.nombre)}
                        &precio=${producto.precio}"
                    >
                        Comprar
                    </a>

                </div>

            `;

        });

        document.getElementById("productos")
            .innerHTML = contenido;

    })

    .catch(error => {

        console.error(error);

    });

</script>

</body>
</html>
