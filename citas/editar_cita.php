<?php
session_start();
require_once('../models/citasmodel.php');

if (isset($_POST['cita_id']) && isset($_POST['fecha']) && isset($_POST['hora']) && isset($_POST['estado'])) {
    $citaId = $_POST['cita_id'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $estado = $_POST['estado'];
    $resultado = [];
    
    $citasModel = new CitasModel();
    if ($citasModel->actualizarCita($citaId, $fecha, $hora, $estado)) {
        $resultado['success'] = true;
    } else {
        $resultado['success'] = false;
    }
    echo json_encode($resultado); 
}
?>
