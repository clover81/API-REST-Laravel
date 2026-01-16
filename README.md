# API REST con Laravel - Tierra Media

Este proyecto consiste en el desarrollo de una **API RESTful** utilizando el framework **Laravel 10**. Ha sido diseñado como parte del módulo de Desarrollo Web en Entorno Servidor de **2º de DAW** en el IES Celia Viñas.

## Descripción
La aplicación expone una interfaz de programación (API) que permite realizar operaciones CRUD completas sobre una base de datos, devolviendo respuestas en formato **JSON**. Se centra en las buenas prácticas de diseño de APIs, como el uso de verbos HTTP adecuados y códigos de estado.

**Funcionalidades clave:**
* Endpoints estructurados para la gestión de recursos.
* Respuestas estandarizadas en formato JSON.
* Validaciones de solicitudes (Request Validation).
* Uso de Eloquent ORM para la interacción con la base de datos.

## Tecnologías y Stack
* **Framework:** Laravel 10.x
* **Lenguaje:** PHP 8.x
* **Base de Datos:** MySQL / MariaDB
* **Herramientas de Testing:** Postman / Insomnia (recomendado para probar los endpoints)

## Instalación y Configuración

Sigue estos pasos para configurar la API en tu entorno local:

1. **Clonar el repositorio:**
   ```bash
   git clone [https://github.com/clover81/API-REST-Laravel.git](https://github.com/clover81/API-REST-Laravel.git)
   cd API-REST-Laravel

2. **Instalar dependencias**
   composer install

3. **Configurar el entorno**
   Crea tu archivo .env: cp .env.example .env

   Genera la clave: php artisan key:generate

   Configura tu base de datos en el archivo .env.

4. **Migraciones**
   php artisan migrate

5. **Servidor**
   php artisan serve

   Desarrollado por [Alejandro Rueda] - Estudiante de 2º DAW en IES Celia Viñas.
   
