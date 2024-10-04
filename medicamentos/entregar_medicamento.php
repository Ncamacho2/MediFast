<?php
session_start();
require_once('../models/config.php');
require_once('../models/MedicamentoModel.php');
require_once('../models/SolicitudModel.php');

$conexion = conectarBaseDatos();
$medicamentoModel = new MedicamentoModel($conexion);
$solicitudModel = new SolicitudModel($conexion);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idSolicitud = $_POST['id_solicitud'];
    $solicitud = $solicitudModel->obtenerSolicitudPorId($idSolicitud);
    $response = [];
    // Verificar si la solicitud ha sido autorizada
    if ($solicitud['estado'] == 'autorizada' || $solicitud['estado'] == 'pendiente') {
        // Actualizar inventario
        if ($medicamentoModel->actualizarInventario($solicitud['id_medicamento'], $solicitud['cantidad'])) {
            $solicitudModel->actualizarEstadoSolicitud($idSolicitud, 'entregada');
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
    } else {
        $response['success'] = false;
    }
    echo json_encode($response);
}
?>
