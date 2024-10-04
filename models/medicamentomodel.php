<?php

class MedicamentoModel {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Obtener todos los medicamentos recetados a un paciente
    public function obtenerMedicamentosRecetados($idPaciente) {
        $query = "SELECT m.id_medicamento, m.nombre, m.tipo, i.cantidad 
                  FROM t_medicamentos m
                  JOIN t_inventario i ON m.id_medicamento = i.id_medicamento
                  JOIN t_recetas r ON m.id_medicamento = r.id_medicamento
                  WHERE r.id_paciente = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $idPaciente);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Verificar la disponibilidad del medicamento en el inventario
    public function verificarDisponibilidad($idMedicamento, $cantidadSolicitada) {
        $query = "SELECT cantidad FROM t_inventario WHERE id_medicamento = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $idMedicamento);
        $stmt->execute();
        $result = $stmt->get_result();
        $inventario = $result->fetch_assoc();
        return ($inventario['cantidad'] >= $cantidadSolicitada);
    }

    // Actualizar la cantidad en el inventario tras la entrega
    public function actualizarInventario($idMedicamento, $cantidad) {
        $query = "UPDATE t_inventario SET cantidad = cantidad - ? WHERE id_medicamento = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('ii', $cantidad, $idMedicamento);
        return $stmt->execute();
    }
}
