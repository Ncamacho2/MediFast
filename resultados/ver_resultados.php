<?php
require_once('../models/config.php');
require_once('../models/resultadosmodel.php');

$conexion = conectarBaseDatos();
$resultadosModel = new ResultadosModel($conexion);

if (isset($_GET['diagnostico_id'])) {
    // Si se pasa un diagnóstico específico, traer resultados de ese diagnóstico
    $diagnosticoId = $_GET['diagnostico_id'];
    $resultados = $resultadosModel->obtenerResultadosPorDiagnostico($diagnosticoId);
} else {
    // Si no se pasa un diagnóstico, traer todos los resultados
    $resultados = $resultadosModel->obtenerTodosLosResultados();
}

echo json_encode($resultados); // Devolver los resultados en formato JSON
