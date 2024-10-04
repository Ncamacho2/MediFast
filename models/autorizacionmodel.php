<?php

class AutorizacionModel {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Registrar una autorización para un medicamento controlado
    public function registrarAutorizacion($idSolicitud, $idAutorizador, $estado) {
        $query = "INSERT INTO t_autorizaciones_medicamentos (id_solicitud, id_autorizador, estado) 
                  VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('iis', $idSolicitud, $idAutorizador, $estado);
        return $stmt->execute();
    }

    // Obtener autorizaciones pendientes
    public function obtenerAutorizacionesPendientes() {
        $query = "SELECT a.id_autorizacion, u.Nombre_usuario AS autorizador, s.id_solicitud, s.estado 
                  FROM t_autorizaciones_medicamentos a
                  JOIN t_solicitudes_medicamentos s ON a.id_solicitud = s.id_solicitud
                  JOIN t_usuarios u ON a.id_autorizador = u.ID_usuario
                  WHERE a.estado = 'pendiente'";
        return $this->conexion->query($query);
    }

    // Actualizar el estado de una autorización
    public function actualizarEstadoAutorizacion($idAutorizacion, $estado) {
        $query = "UPDATE t_autorizaciones_medicamentos SET estado = ? WHERE id_autorizacion = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('si', $estado, $idAutorizacion);
        return $stmt->execute();
    }
}
