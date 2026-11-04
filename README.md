# TechMarket Online

Proyecto académico desarrollado en SENATI para el curso Fundamentos de Programación Web. Es una tienda web de demostración que permite administrar productos y registrar compras usando PHP y MySQL.

## Funcionalidades

- Mostrar un catálogo de productos.
- Registrar, editar y eliminar productos.
- Agregar productos a un carrito de compras.
- Registrar los datos del cliente y el detalle de la compra.
- Actualizar el stock después de registrar una compra.

> Este proyecto demuestra un flujo de compra académico. No está conectado a un servicio real de pagos.

## Tecnologías

PHP, MySQL, PDO, JavaScript, AJAX, HTML, CSS y XAMPP. La aplicación aplica programación orientada a objetos y una estructura básica MVC.

## Requisitos

- XAMPP con Apache y MySQL.
- Un navegador web.
- El archivo SQL de la base de datos del proyecto.

## Instalación y ejecución

1. Clona este repositorio dentro de la carpeta `htdocs` de XAMPP.
2. Inicia Apache y MySQL desde el panel de XAMPP.
3. Abre `http://localhost/phpmyadmin` y crea la base de datos `tienda`.
4. Importa el archivo `proyecto_tec/database/tienda.sql`.
5. Revisa la configuración de conexión en `proyecto_tec/config/database.php`.
6. Abre `http://localhost/pagina-web-principiante/proyecto_tec/`.

## Prueba rápida

1. Registra uno o más productos desde la sección de administración.
2. Agrégalos al carrito.
3. Completa el formulario de compra con datos de prueba.
4. Comprueba que se registre la compra y que se actualice el stock.

## Estructura del proyecto

- `proyecto_tec/`: aplicación web.
- `proyecto_tec/models/`: acceso a productos, clientes y compras.
- `proyecto_tec/controllers/`: lógica que conecta modelos y aplicación.
- `proyecto_tec/ajax/`: operaciones entre la interfaz y el servidor.
- `proyecto_tec/productos/`: catálogo, administración, carrito y compra.
- `Trabajofinal_fundamentosweb.docx`: informe detallado del proceso.

## Informe

Consulta el [informe del proyecto](Trabajofinal_fundamentosweb.docx).
