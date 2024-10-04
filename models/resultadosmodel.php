<?php
require_once('config.php');
class ResultadosModel
{
    private $conexion;

    public function __construct($conexion)
    {
        // Usar la función conectarBaseDatos() desde config.php
        $this->conexion = conectarBaseDatos();
    }

    // Método para agregar un nuevo resultado de examen
    public function agregarResultado($tipoExamen, $descripcion, $fechaExamen, $diagnosticoId, $observaciones = null)
    {
        $consulta = "INSERT INTO t_resultados_examen (tipo_examen, descripcion, fecha_examen, diagnostico_id, observaciones) 
                     VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bind_param('sssis', $tipoExamen, $descripcion, $fechaExamen, $diagnosticoId, $observaciones);
        return $stmt->execute();
    }

    // Método para obtener los resultados por diagnóstico
    public function obtenerResultadosPorDiagnostico($diagnosticoId)
    {
        $consulta = "SELECT * FROM t_resultados_examen WHERE diagnostico_id = ?";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bind_param('i', $diagnosticoId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Método para obtener resultados y el paciente asociado
    public function obtenerResultadosConPaciente($diagnosticoId)
    {
        $consulta = "
            SELECT r.*, p.nombre_paciente, p.paciente_id
            FROM t_resultados_examen r
            JOIN t_diagnostico d ON r.diagnostico_id = d.diagnostico_id
            JOIN t_paciente p ON d.paciente_id = p.paciente_id
            WHERE r.diagnostico_id = ?
        ";

        $stmt = $this->conexion->prepare($consulta);
        $stmt->bind_param('i', $diagnosticoId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Método para eliminar un resultado por ID
    public function eliminarResultado($idResultado)
    {
        $consulta = "DELETE FROM t_resultados_examen WHERE id_resultado = ?";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bind_param('i', $idResultado);
        return $stmt->execute();
    }

    public function obtenerTodosLosResultados()
    {
        $consulta = "
        SELECT r.id_resultado, r.tipo_examen, r.descripcion AS resultado_descripcion, r.fecha_examen, r.observaciones, 
               d.descripcion AS diagnostico_descripcion, u.Nombre_usuario AS nombre_paciente
        FROM t_resultados_examen r
        JOIN t_diagnostico d ON r.diagnostico_id = d.diagnostico_id
        JOIN t_paciente p ON d.paciente_id = p.paciente_id
        JOIN t_usuarios u ON p.id_usuario = u.ID_usuario
    ";
        $resultado = $this->conexion->query($consulta);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

}
?>