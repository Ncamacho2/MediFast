<?php
// Incluir el archivo de configuración
require_once('config.php');
class LoginModel
{

    private $conexion;

    public function __construct()
    {
        // Usar la función conectarBaseDatos() desde config.php
        $this->conexion = conectarBaseDatos();
    }
    
    // Función para verificar las credenciales en la base de datos
    public function verificarCredenciales($nombre_usuario, $contraseña)
    {
        // Consulta SQL para verificar las credenciales
        $consulta = "SELECT * FROM t_usuarios WHERE Nombre_usuario = '$nombre_usuario' AND Password_usuario = '$contraseña'";

        // Ejecutar la consulta
        $resultado = $this->conexion->query($consulta);

        // Verificar si se encontraron resultados
        if ($resultado->num_rows > 0) {
            // Credenciales válidas
            // Obtener el ID del usuario
            // Obtener el rol del usuario
            $usuario = $resultado->fetch_assoc();
            $id_usuario = $usuario['ID_Usuario'];
            $rol_usuario = $usuario['Rol_usuario'];
            $nombre_usuario = $usuario['Nombre_usuario'];

            // Almacenar el ID y rol del usuario en la sesión
            $_SESSION['usuario_autenticado'] = $id_usuario;
            $_SESSION['rol_usuario'] = $rol_usuario;
            $_SESSION['nombre_usuario'] = $nombre_usuario;

            return true;
        } else {
            // Credenciales inválidas
            return false;
        }
    }

    // Método para obtener el nombre de usuario basado en su ID
    public function obtenerNombreUsuario($id_usuario)
    {
        // Consulta SQL para obtener el nombre de usuario del usuario
        $consulta = "SELECT Nombre_usuario FROM t_usuarios WHERE ID_Usuario = '$id_usuario'";

        // Ejecutar la consulta
        $resultado = $this->conexion->query($consulta);

        // Verificar si se encontraron resultados
        if ($resultado->num_rows > 0) {
            // Devolver el nombre de usuario
            $usuario = $resultado->fetch_assoc();
            return $usuario['Nombre_usuario'];
        } else {
            // Si no se encuentra el usuario, devuelve un valor nulo o maneja el error según sea necesario
            return null;
        }
    }

    // Método para obtener el ID de usuario basado en su nombre de usuario
    public function obtenerIdUsuarioPorNombre($nombre_usuario)
    {
        // Consulta SQL para obtener el ID de usuario del usuario
        $consulta = "SELECT ID_Usuario FROM t_usuarios WHERE Nombre_usuario = '$nombre_usuario'";

        // Ejecutar la consulta
        $resultado = $this->conexion->query($consulta);

        // Verificar si se encontraron resultados
        if ($resultado->num_rows > 0) {
            // Devolver el ID de usuario
            $usuario = $resultado->fetch_assoc();
            return $usuario['ID_Usuario'];
        } else {
            // Si no se encuentra el usuario, devuelve un valor nulo o maneja el error según sea necesario
            return null;
        }
    }


    // Destructor para cerrar la conexión a la base de datos
    public function __destruct()
    {
        // Cerrar la conexión
        $this->conexion->close();
    }
}
