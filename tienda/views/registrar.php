<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Registrar Producto</title>

    <link rel="stylesheet" href="../css/estilos.css">-->
    

</head>

<body>

<header>

    <h1>Registrar Producto</h1>

</header>

<main>

<form
    action="../views/guardar.php"
    method="POST"
    enctype="multipart/form-data"
>

    <label>Nombre del producto</label>

    <input
        type="text"
        name="nombre"
        required
    >

    <label>Precio</label>

    <input
        type="number"
        name="precio"
        step="0.01"
        required
    >

    <label>Imagen</label>

    <input
        type="file"
        name="imagen"
        accept="image/*"
        required
    >

    <button type="submit">
        Guardar producto
    </button>

</form>

</main>

</body>

</html>