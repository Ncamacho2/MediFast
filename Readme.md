# Sistema de Gestión de Salud "MEDIFAST"

Este proyecto es un **Sistema de Gestión de Salud "MEDIFAST"**   desarrollado en PHP con MySQL y utilizando Bootstrap para el diseño de la interfaz de usuario. El sistema permite a los usuarios gestionar citas médicas, acceder a historias clínicas, comunicarse mediante chat, visualizar resultados de exámenes, gestionar autorizaciones de procedimientos y más.

# https://violet-manatee-768035.hostingersite.com/MediFast/views/login.php

![image](https://github.com/user-attachments/assets/be328fc6-d324-4884-9dda-b05dc72d88a3)

![image](https://github.com/user-attachments/assets/ea928ffc-0d85-421a-bac2-8ea9f9e69ad3)


## Funcionalidades

1. **Gestionar Citas Médicas**: Los pacientes pueden programar, modificar o cancelar citas médicas con los médicos.
2. **Acceder a Historia Clínica**: Los pacientes y los médicos pueden acceder a las historias clínicas de los pacientes.
3. **Comunicarse mediante Chat**: Los pacientes pueden comunicarse en tiempo real con médicos o personal administrativo.
4. **Visualizar Resultados de Exámenes y Procedimientos**: Los pacientes pueden acceder a los resultados de exámenes médicos.
5. **Tramitar Autorizaciones de Medicamentos y Procedimientos**: El sistema automatiza las solicitudes y autorizaciones de medicamentos y procedimientos con proveedores de seguros.


## Requisitos

- Servidor Web (Apache, Nginx, etc.)
- PHP 7.0 o superior
- MySQL 5.7 o superior
- Bootstrap 5 (incluido en el proyecto)
- phpMyAdmin (opcional, para gestionar la base de datos)

## Instalación

1. Clonar este repositorio:

    ```bash
    git clone https://github.com/tu_usuario/sistema_salud.git
    ```

2. Configurar la base de datos:
   - Importar el archivo SQL incluido (`database.sql`) en tu servidor MySQL para crear las tablas necesarias.
   - Configurar la conexión a la base de datos en el archivo `/includes/db.php`.

    ```php
    <?php
    $host = 'localhost';
    $dbname = 'medifast';
    $username = 'tu_usuario';
    $password = 'tu_contraseña';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("ERROR: No se pudo conectar. " . $e->getMessage());
    }
    ?>
    ```

3. Configurar el servidor web:
   - Coloca el proyecto en la carpeta raíz del servidor web (por ejemplo, `htdocs` en Apache).
   - Asegúrate de que el servidor tenga acceso a la base de datos y esté configurado para ejecutar archivos PHP.

4. Acceder al sistema:
   - Abre tu navegador y navega a `http://localhost/medifast` o la ruta donde instalaste el proyecto.

## Uso del Sistema

### Roles del Sistema
- **Paciente**: Puede gestionar sus citas, ver sus historias clínicas, comunicarse mediante chat y visualizar resultados médicos.
- **Médico**: Accede a las historias clínicas de los pacientes, se comunica mediante chat y prescribe procedimientos y medicamentos.
- **Personal Administrativo**: Gestiona la disponibilidad de los médicos, maneja reportes, autorizaciones, y asigna permisos de seguridad.

### Casos de Uso
- [ ] Gestionar Citas Médicas
- [ ] Acceder a Historia Clínica
- [ ] Comunicarse mediante Chat
- [ ] Visualizar Resultados de Exámenes
- [ ] Tramitar Autorizaciones de Medicamentos
- [ ] Administrar Disponibilidad de Especialistas
- [ ] Generar Reportes y Estadísticas
- [ ] Gestionar Seguridad y Permisos

## Contribuciones

Las contribuciones son bienvenidas. Por favor, abre un "issue" o un "pull request" para sugerir mejoras o reportar errores.

## Licencia

Este proyecto está licenciado bajo la [MIT License](https://opensource.org/licenses/MIT).

