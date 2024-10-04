<?php
require_once('../models/config.php');

if (isset($_POST['paciente_id'])) {
    $conexion = conectarBaseDatos();
    $pacienteId = $_POST['paciente_id'];

    // Obtener los diagnósticos asociados al paciente
    $consulta = "SELECT diagnostico_id, descripcion FROM t_diagnostico WHERE paciente_id = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param('i', $pacienteId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($diagnostico = $result->fetch_assoc()) {
            echo '<option value="' . $diagnostico['diagnostico_id'] . '">' . $diagnostico['descripcion'] . '</option>';
        }
    } else {
        echo '<option value="">No hay diagnósticos disponibles</option>';
    }

    $stmt->close();
    $conexion->close();
}
