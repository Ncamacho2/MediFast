<?php
// Archivo de configuración de la base de datos

// Detectar el entorno según el nombre del servidor
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    // Configuración para entorno local
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'medifast');
} else {
    // Configuración para entorno de producción (hosting)
    define('DB_HOST', 'localhost');  // Aquí colocas el nombre del servidor de Hostinger
    define('DB_USER', 'u744168167_desarrolloapa');
    define('DB_PASSWORD', 'H9d_*NJz_iF@9Pk');
    define('DB_NAME', 'u744168167_medifast');
}

// Función para establecer la conexión a la base de datos
function conectarBaseDatos()
{
    $conexion = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    return $conexion;
}
?>
