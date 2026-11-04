# TechMarket Online

> **Proyecto académico de tercer ciclo** de la carrera de Desarrollo de Software en SENATI. Desarrollado para el curso Fundamentos de Programación Web.

## 📥 Informe completo del proyecto

El informe documenta el caso práctico, la propuesta, el desarrollo de la tienda y las evidencias del proceso.

**[ DESCARGAR EL INFORME COMPLETO DEL PROYECTO (WORD)](https://raw.githubusercontent.com/Eucalipto-23/pagina-web-principiante/main/Trabajofinal_fundamentosweb.docx)**

## Descripción

TechMarket Online es una tienda web de demostración desarrollada como proyecto de tercer ciclo. Permite administrar productos y registrar compras mediante PHP y MySQL.

## Funcionalidades

- Mostrar un catálogo de productos.
- Registrar, editar y eliminar productos.
- Agregar productos a un carrito de compras.
- Registrar los datos del cliente y el detalle de la compra.
- Actualizar el stock después de registrar una compra.

> El proyecto implementa un flujo de compra académico; no está conectado a un servicio real de pagos.

## Tecnologías

PHP, MySQL, PDO, JavaScript, AJAX, HTML, CSS y XAMPP. La aplicación aplica programación orientada a objetos y una estructura básica MVC.

## Requisitos

- XAMPP con Apache y MySQL.
- Un navegador web.
- Una base de datos MySQL llamada `tienda`.

## Instalación y ejecución

1. Clona este repositorio dentro de la carpeta `htdocs` de XAMPP.
2. Inicia Apache y MySQL desde el panel de XAMPP.
3. Crea en MySQL la base de datos `tienda` y sus tablas.
4. Revisa la conexión en `proyecto_tec/config/database.php`.
5. Abre `http://localhost/pagina-web-principiante/proyecto_tec/`.

> El repositorio todavía no incluye un archivo SQL para crear las tablas. Para que otra persona pueda instalar el proyecto fácilmente, agrega una exportación del esquema, por ejemplo `proyecto_tec/database/tienda.sql`, y enlázala aquí.

## Prueba rápida

1. Registra uno o más productos desde la sección de administración.
2. Agrégalos al carrito.
3. Completa el formulario de compra con datos de prueba.
4. Comprueba que se registre la compra y se actualice el stock.

## Estructura del proyecto

- `proyecto_tec/`: aplicación web.
- `proyecto_tec/models/`: acceso a productos, clientes y compras.
- `proyecto_tec/controllers/`: lógica que conecta modelos y aplicación.
- `proyecto_tec/ajax/`: operaciones entre la interfaz y el servidor.
- `proyecto_tec/productos/`: catálogo, administración, carrito y compra.
- `Trabajofinal_fundamentosweb.docx`: informe detallado del proyecto.
