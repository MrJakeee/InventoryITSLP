# 📦 InventoryITSLP

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)

Sistema de gestión de inventarios desarrollado para el **Instituto Tecnológico de San Luis Potosí**. Esta aplicación permite administrar de manera eficiente los recursos institucionales mediante una arquitectura robusta y una interfaz intuitiva.

---

## ✨ Características Principales

* **Módulo de Seguridad:** Autenticación de usuarios con diferentes niveles de acceso.
* **Gestión de Inventario (CRUD):** Registro, consulta, actualización y eliminación de artículos.
* **Consultas Asíncronas:** Implementación de **AJAX** para una experiencia de usuario fluida sin recargas de página.
* **Arquitectura MVC:** Separación clara entre la lógica de negocio, los datos y la interfaz.

## 📂 Estructura del Directorio

| Carpeta / Archivo | Descripción |
| :--- | :--- |
| `ajax/` | Controladores para peticiones asíncronas de JavaScript. |
| `controladores/` | Lógica de control que conecta los modelos con las vistas. |
| `modelos/` | Gestión de la base de datos y consultas SQL. |
| `vistas/` | Archivos HTML, CSS y recursos visuales del sistema. |
| `index.php` | Punto de acceso principal a la aplicación. |

## 🛠️ Instalación y Configuración

Sigue estos pasos para montar el proyecto en tu entorno local:

### 1. Requisitos
* Servidor local (XAMPP, Laragon o WAMP).
* PHP versión 7.4 o superior.
* Gestor de base de datos MySQL.

### 2. Clonación
```bash
git clone [https://github.com/MrJakeee/InventoryITSLP.git](https://github.com/MrJakeee/InventoryITSLP.git)
