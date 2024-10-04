<?php
session_start();
require_once('../models/citasmodel.php');

if (isset($_POST['cita_id'])) {
    $citaId = $_POST['cita_id'];
    $citasModel = new CitasModel();
    if ($citasModel->eliminarCita($citaId)) {
        $resultado['success'] = true;
    } else {
        $resultado['success'] = false;
    }
    echo json_encode($resultado); 
}
?>