<?php

class SolicitudModel {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Registrar una nueva solicitud
    public function registrarSolicitud($idPaciente, $idMedicamento, $cantidad) {
        $query = "INSERT INTO t_solicitudes_medicamentos (id_paciente, id_medicamento, cantidad) 
                  VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('iii', $idPaciente, $idMedicamento, $cantidad);
        return $stmt->execute();
    }

    // Obtener solicitudes pendientes de autorización
    public function obtenerSolicitudesPendientes() {
        $query = "SELECT s.id_solicitud, u.Nombre_usuario AS paciente, m.nombre AS medicamento, s.cantidad, s.estado 
                  FROM t_solicitudes_medicamentos s
                  JOIN t_usuarios u ON s.id_paciente = u.ID_usuario
                  JOIN t_medicamentos m ON s.id_medicamento = m.id_medicamento
                  WHERE s.estado = 'pendiente'";
        return $this->conexion->query($query);
    }

      // Obtener solicitudes pendientes de autorización
      public function obtenerSolicitudes() {
        $query = "SELECT s.id_solicitud, u.Nombre_usuario AS paciente, m.nombre AS medicamento, s.cantidad, s.estado 
                  FROM t_solicitudes_medicamentos s
                  JOIN t_usuarios u ON s.id_paciente = u.ID_usuario
                  JOIN t_medicamentos m ON s.id_medicamento = m.id_medicamento
                  ";
        return $this->conexion->query($query);
    }

    // Actualizar el estado de la solicitud
    public function actualizarEstadoSolicitud($idSolicitud, $estado) {
        $query = "UPDATE t_solicitudes_medicamentos SET estado = ? WHERE id_solicitud = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('si', $estado, $idSolicitud);
        return $stmt->execute();
    }

    // Obtener la solicitud por su ID
    public function obtenerSolicitudPorId($idSolicitud) {
        $query = "SELECT * FROM t_solicitudes_medicamentos WHERE id_solicitud = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $idSolicitud);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
