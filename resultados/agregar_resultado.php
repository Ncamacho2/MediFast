<?php
session_start();
require_once('../models/config.php');
require_once('../models/resultadosmodel.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexion = conectarBaseDatos();
    $resultadosModel = new ResultadosModel($conexion);

    $tipoExamen = $_POST['tipo_examen'];
    $descripcion = $_POST['descripcion'];
    $fechaExamen = $_POST['fecha_examen'];
    $diagnosticoId = $_POST['diagnostico_id'];
    $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : null;

    $resultado = [];
    try {
        // Intentar agregar el resultado
        if ($resultadosModel->agregarResultado($tipoExamen, $descripcion, $fechaExamen, $diagnosticoId, $observaciones)) {
            $resultado['success'] = true;
        } else {
            $resultado['success'] = false;
            $resultado['message'] = 'Error al agregar el resultado. Intente de nuevo.';
        }
    } catch (Exception $e) {
        // Capturar cualquier excepción
        $resultado['success'] = false;
        $resultado['message'] = 'Se produjo un error: ' . $e->getMessage();
    }


    echo json_encode($resultado); // Responder en formato JSON
}
?>
