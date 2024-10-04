<?php
require_once('../models/citasmodel.php');

if (isset($_POST['cita_id'])) {
    $citaId = $_POST['cita_id'];
    $citasModel = new CitasModel();
    $cita = $citasModel->obtenerCitaPorId($citaId); // Debes implementar este método en el modelo
    echo json_encode($cita);
}
