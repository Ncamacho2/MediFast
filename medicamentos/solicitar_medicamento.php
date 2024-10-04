<?php
session_start();
require_once('config.php');
require_once('models/MedicamentoModel.php');
require_once('models/SolicitudModel.php');

$medicamentoModel = new MedicamentoModel($conexion);
$solicitudModel = new SolicitudModel($conexion);

if ($_SESSION['rol_usuario'] != 'Paciente') {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPaciente = $_SESSION['ID_usuario'];
    $idMedicamento = $_POST['id_medicamento'];
    $cantidad = $_POST['cantidad'];

    // Verificar disponibilidad en inventario
    if ($medicamentoModel->verificarDisponibilidad($idMedicamento, $cantidad)) {
        // Registrar la solicitud
        if ($solicitudModel->registrarSolicitud($idPaciente, $idMedicamento, $cantidad)) {
            echo "Solicitud realizada.";
        } else {
            echo "Error al registrar la solicitud.";
        }
    } else {
        echo "Cantidad no disponible en inventario.";
    }
}
?>
