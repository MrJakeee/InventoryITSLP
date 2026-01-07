InventoryITSLP - Sistema de Gestión de Inventario
Sistema web desarrollado para el control y administración de inventarios del Instituto Tecnológico de San Luis Potosí. Este proyecto utiliza una arquitectura MVC (Modelo-Vista-Controlador) para garantizar un código organizado y escalable.

🚀 Características
Autenticación segura: Sistema de login para administradores y personal autorizado.

Gestión de Artículos: Registro, edición, baja y consulta de bienes.

Interfaz Dinámica: Uso de AJAX para actualizaciones de datos sin recargar la página.

Diseño Responsivo: Adaptable a diferentes dispositivos.

🛠️ Tecnologías Utilizadas
Lenguaje: PHP 7.x / 8.x

Base de Datos: MySQL

Frontend: HTML5, CSS3 (Bootstrap), JavaScript (jQuery)

Arquitectura: MVC (Modelo-Vista-Controlador)

📋 Requisitos Previos
Para ejecutar este proyecto localmente, necesitarás un entorno de servidor local como:

XAMPP o Laragon.

PHP >= 7.4

MySQL/MariaDB

🔧 Instalación
Clonar el repositorio:

Bash

git clone https://github.com/MrJakeee/InventoryITSLP.git
Configurar la Base de Datos:

Crea una base de datos en tu gestor (phpMyAdmin).

Importa el archivo .sql (si se encuentra en la carpeta de modelos o raíz).

Configura las credenciales de conexión en el archivo correspondiente (usualmente en la carpeta modelos/conexion.php).

Despliegue:

Mueve la carpeta del proyecto a htdocs (XAMPP) o www (WAMP).

Accede desde tu navegador a http://localhost/InventoryITSLP.

📂 Estructura del Proyecto
/ajax: Procesamiento de peticiones asíncronas.

/controladores: Lógica de la aplicación.

/modelos: Conexión a BD y consultas.

/vistas: Interfaz de usuario y recursos (CSS/JS).

index.php: Punto de entrada principal.

✒️ Autores
Jake - Desarrollo Inicial - MrJakeee
