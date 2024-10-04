<?php
require_once('config.php');
class HistoriaClinicaModel
{
    private $conexion;

    public function __construct()
    {
        // Usar la función conectarBaseDatos() desde config.php
        $this->conexion = conectarBaseDatos();
    }

    // Método para obtener la historia clínica con diagnósticos
    public function obtenerHistoriaClinicaConDiagnosticos()
    {
        $consulta = "SELECT hc.historia_clinica_id, u.Nombre_usuario AS nombre_paciente, d.fecha, d.tipo, d.resultado, d.descripcion, d.diagnostico_id
                     FROM t_historia_clinica hc
                     JOIN t_paciente p ON hc.paciente_id = p.paciente_id
                     JOIN t_usuarios u ON p.id_usuario = u.ID_usuario
                     JOIN t_diagnostico d ON hc.historia_clinica_id = d.historia_clinica_id";
        $resultado = $this->conexion->query($consulta);

        $diagnosticos = array();
        while ($fila = $resultado->fetch_assoc()) {
            $diagnosticos[] = $fila;
        }
        return $diagnosticos;
    }

    // Destructor para cerrar la conexión
    public function __destruct()
    {
        $this->conexion->close();
    }
}
?>
