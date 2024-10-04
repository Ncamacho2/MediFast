<?php
// Incluir el archivo de configuración
require_once('config.php');

class CitasModel
{
    private $conexion;

    public function __construct()
    {
        // Usar la función conectarBaseDatos() desde config.php
        $this->conexion = conectarBaseDatos();
    }
   


    // Método para obtener todas las citas
    public function obtenerCitas()
    {
        $consulta = "SELECT c.*, p.Nombre_usuario AS nombre_paciente, m.Nombre_usuario AS nombre_medico 
                     FROM t_cita c
                     JOIN t_usuarios p ON c.paciente_id = p.ID_usuario
                     JOIN t_usuarios m ON c.medico_id = m.ID_usuario";

        $resultado = $this->conexion->query($consulta);
        if ($resultado->num_rows > 0) {
            $citas = array();
            while ($fila = $resultado->fetch_assoc()) {
                $citas[] = $fila;
            }
            return $citas;
        } else {
            return array();
        }
    }

    // Destructor para cerrar la conexión
    public function __destruct()
    {
        $this->conexion->close();
    }

    // Método para actualizar una cita médica
    public function actualizarCita($id, $fecha, $hora, $estado)
{
    $consulta = "UPDATE t_cita SET fecha = ?, hora = ?, estado = ? WHERE cita_id = ?";
    $stmt = $this->conexion->prepare($consulta);
    $stmt->bind_param('sssi', $fecha, $hora, $estado, $id);
    return $stmt->execute();
}


    // Método para eliminar una cita médica
    public function eliminarCita($citaId)
{
    $consulta = "DELETE FROM t_cita WHERE cita_id = ?";
    $stmt = $this->conexion->prepare($consulta);
    $stmt->bind_param('i', $citaId);
    return $stmt->execute();
}


    // Método para crear una nueva cita
    public function crearCita($fecha, $hora, $pacienteId, $medicoId, $estado)
    {
        $consulta = "INSERT INTO t_cita (fecha, hora, paciente_id, medico_id, estado) VALUES ('$fecha', '$hora', '$pacienteId', '$medicoId', '$estado')";
        return $this->conexion->query($consulta) === TRUE;
    }

    public function obtenerCitaPorId($citaId)
{
    // Consulta SQL para obtener los detalles de una cita específica por su ID
    $consulta = "SELECT cita_id, fecha, hora, estado FROM t_cita WHERE cita_id = ?";
    $stmt = $this->conexion->prepare($consulta);
    $stmt->bind_param('i', $citaId);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si se encontró la cita
    if ($resultado->num_rows > 0) {
        return $resultado->fetch_assoc(); // Retornar la cita como un array asociativo
    } else {
        return null; // Retornar null si no se encuentra la cita
    }
}

}
?>
