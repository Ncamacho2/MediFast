<?php
require_once('config.php');
class UsuariosModel
{
   
    private $conexion;

    public function __construct()
    {
        // Usar la función conectarBaseDatos() desde config.php
        $this->conexion = conectarBaseDatos();
    }

    // Método para obtener todos los usuarios de la base de datos
    public function obtenerUsuarios()
    {
        // Consulta SQL para obtener todos los usuarios
        $consulta = "SELECT * FROM t_usuarios";

        // Ejecutar la consulta
        $resultado = $this->conexion->query($consulta);

        // Verificar si se obtuvieron resultados
        if ($resultado->num_rows > 0) {
            // Crear un array para almacenar los usuarios
            $usuarios = array();

            // Iterar sobre los resultados y almacenar cada usuario en el array
            while ($fila = $resultado->fetch_assoc()) {
                $usuarios[] = $fila;
            }

            // Devolver el array de usuarios
            return $usuarios;
        } else {
            // Si no se encontraron usuarios, devolver un array vacío o manejar el caso según sea necesario
            return array();
        }
    }

    // Destructor para cerrar la conexión a la base de datos
    public function __destruct()
    {
        // Cerrar la conexión
        $this->conexion->close();
    }

    // Método para actualizar un usuario en la base de datos
    public function actualizarUsuario($id, $nombre, $email, $rol, $telefono, $password)
    {
        // Preparar la consulta SQL para actualizar el usuario
        $consulta = "UPDATE t_usuarios SET Nombre_usuario = '$nombre', Email_usuario = '$email', 
                     Rol_usuario = '$rol', Telefono_usuario = '$telefono', Password_usuario = '$password'
                     WHERE ID_usuario = '$id'";

        // Ejecutar la consulta
        if ($this->conexion->query($consulta) === TRUE) {
            // La actualización se realizó correctamente
            return true;
        } else {
            // La actualización falló, manejar el error según sea necesario
            return false;
        }
    }
    
    // Método para obtener la información del usuario por su ID
    public function obtenerUsuarioPorId($usuarioId) {
        // Consulta SQL para obtener la información del usuario por su ID
        $consulta = "SELECT * FROM t_usuarios WHERE ID_usuario = '$usuarioId'";

        // Ejecutar la consulta
        $resultado = $this->conexion->query($consulta);

        // Verificar si se encontraron resultados
        if ($resultado->num_rows > 0) {
            // Devolver los datos del usuario en formato de arreglo asociativo
            return $resultado->fetch_assoc();
        } else {
            // Si no se encuentra el usuario, devuelve un valor nulo o maneja el error según sea necesario
            return null;
        }
    }
    
    // Método para eliminar un usuario por su ID
    public function eliminarUsuario($usuarioId) {
        // Consulta SQL para eliminar el usuario por su ID
        $consulta = "DELETE FROM t_usuarios WHERE ID_usuario = '$usuarioId'";

        // Ejecutar la consulta
        if ($this->conexion->query($consulta) === TRUE) {
            return true; // La operación fue exitosa
        } else {
            return false; // Hubo un error en la operación
        }
    }

    public function crearUsuario($nombre, $email, $rol, $telefono, $password) {
        // Consulta SQL para insertar el usuario
        $sql = "INSERT INTO t_usuarios (Nombre_usuario, Email_usuario, Rol_usuario, Telefono_usuario, Password_usuario) VALUES (?, ?, ?, ?, ?)";
        
        // Preparar la consulta
        $consulta = $this->conexion->prepare($sql);
        
        // Verificar si la preparación de la consulta fue exitosa
        if ($consulta) {
            // Enlazar parámetros
            $consulta->bind_param('sssss', $nombre, $email, $rol, $telefono, $password); // 'sssss' indica que todos los parámetros son strings
            
            // Ejecutar la consulta
            if ($consulta->execute()) {
                // La inserción fue exitosa
                return true;
            } else {
                // La inserción falló, manejar el error según sea necesario
                return false;
            }
        } else {
            // Si la preparación de la consulta falló, manejar el error según sea necesario
            return false;
        }
    }
    public function obtenerPacientes()
{
    $consulta = "SELECT u.ID_usuario, u.Nombre_usuario 
                 FROM t_paciente p 
                 JOIN t_usuarios u ON p.id_usuario = u.ID_usuario";
    $resultado = $this->conexion->query($consulta);

    $pacientes = array();
    while ($fila = $resultado->fetch_assoc()) {
        $pacientes[] = $fila;
    }
    return $pacientes;
}
public function obtenerMedicos()
{
    $consulta = "SELECT u.ID_usuario, u.Nombre_usuario 
                 FROM t_medico m 
                 JOIN t_usuarios u ON m.id_usuario = u.ID_usuario";
    $resultado = $this->conexion->query($consulta);

    $medicos = array();
    while ($fila = $resultado->fetch_assoc()) {
        $medicos[] = $fila;
    }
    return $medicos;
}
public function obtenerMedicosConEspecialidad()
{
    $consulta = "SELECT u.ID_usuario, u.Nombre_usuario, m.especialidad 
                 FROM t_medico m 
                 JOIN t_usuarios u ON m.id_usuario = u.ID_usuario";
    $resultado = $this->conexion->query($consulta);

    $medicos = array();
    while ($fila = $resultado->fetch_assoc()) {
        $medicos[] = $fila;
    }
    return $medicos;
}

    
}
?>