<?php
session_start();
require_once('../models/config.php');
require_once('../models/resultadosmodel.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_resultado'])) {
    $conexion = conectarBaseDatos();
    $resultadosModel = new ResultadosModel($conexion);

    $idResultado = $_POST['id_resultado'];
    $resultado = [];

    if ($resultadosModel->eliminarResultado($idResultado)) {
        $resultado['success'] = true;
    } else {
        $resultado['success'] = false;
    }

    echo json_encode($resultado); // Responder en formato JSON
}
?>
