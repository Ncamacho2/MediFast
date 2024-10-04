<?php
// Archivo de configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'medifast'); 
              
class ItemsModel
{
    private $conexion;

    public function __construct()
    {
        // Incluir el archivo de configuración de la base de datos
        require_once('db.php');

        // Crear la conexión utilizando PDO
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        $opciones = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->conexion = new PDO($dsn, DB_USER, DB_PASS, $opciones);
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    // Resto de métodos de la clase ItemsModel...
}
