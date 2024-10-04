<?php
session_start();
require_once('../models/config.php');
require_once('../models/autorizacionmodel.php');
require_once('../models/solicitudmodel.php');

$conexion = conectarBaseDatos();
$autorizacionModel = new AutorizacionModel($conexion);
$solicitudModel = new SolicitudModel($conexion);

$response = [];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idSolicitud = $_POST['id_solicitud'];
        $estado = $_POST['estado'];
        $idAutorizador = $_SESSION['usuario_autenticado'];

        // Actualizar el estado de la solicitud
        if (!$autorizacionModel->registrarAutorizacion($idSolicitud, $idAutorizador, $estado)) {
            throw new Exception("Error al registrar la autorización.");
        }

        if (!$solicitudModel->actualizarEstadoSolicitud($idSolicitud, $estado)) {
            throw new Exception("Error al actualizar el estado de la solicitud.");
        }

        $response['success'] = true;
    }
} catch (Exception $e) {
    // Captura cualquier excepción y registra el error en un archivo log
    $response['success'] = false;
    $response['message'] = 'Ocurrió un error: ' . $e->getMessage();

    // Registrar el error en un archivo de log
 //   error_log(date("[Y-m-d H:i:s]") . " Error en solicitud: " . $e->getMessage() . "\n", 3, __DIR__ . '/logs/error_log.txt');
}

// Devolver la respuesta en formato JSON
echo json_encode($response);
?>
