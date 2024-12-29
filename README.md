# VulnSocial - TFG de Desarrollo de Aplicaciones Web

VulnSocial es una aplicación web diseñada como parte de un Trabajo de Fin de Grado (TFG) para el ciclo de Desarrollo de Aplicaciones Web. Combina las funcionalidades de una red social con un enfoque en la concienciación sobre ciberseguridad mediante la implementación de vulnerabilidades web controladas y herramientas educativas.

---

## Características principales

- **Funcionalidades de red social:** Registro, login, creación de posts, likes, comentarios y chat.
- **Panel de administración:** Gestión de usuarios, estadísticas y gráficos interactivos para el administrador y el manager.
- **Vulnerabilidades controladas:** Simulación de vulnerabilidades como XSS, SQL Injection y CSRF, entre otras.
- **Asistente de IA:** Evaluación de sentimientos en los posts utilizando la API de Hugging Face.
- **Enfoque educativo:** Diseño para enseñar buenas prácticas de desarrollo seguro.

---

## Requisitos previos

1. **Software necesario:**
   - [XAMPP](https://www.apachefriends.org/) (PHP, MySQL, y Apache).
   - Navegador web actualizado.
   - Git (opcional, para clonar el repositorio).

2. **Configuración del entorno:**
   - Sistema operativo: Windows, macOS o Linux.
   - Conexión a Internet para las dependencias externas.

---

## Instalación y configuración

### Paso 1: Clonar el repositorio
```
git clone https://github.com/tu-usuario/vulnsocial.git
```

O descarga el proyecto como un archivo ZIP desde GitHub y extrae los archivos.

### PASO 2: Configurar XAMPP
Inicia XAMPP y activa los módulos Apache y MySQL.
Copia la carpeta del proyecto vulnsocial a la carpeta htdocs de XAMPP.

### PASO 3: Configurar la base de datos
Abre phpMyAdmin desde http://localhost/phpmyadmin.
Crea una nueva base de datos llamada vulnerable_app.
Importa el archivo SQL incluido en el proyecto:
Ve a la pestaña "Importar".
Selecciona el archivo vulnerable_app.sql.
Haz clic en "Continuar".
