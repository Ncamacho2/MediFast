<?php
session_start();
require_once('config.php');
require_once('models/SolicitudModel.php');

$solicitudModel = new SolicitudModel($conexion);
$solicitudesPendientes = $solicitudModel->obtenerSolicitudesPendientes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autorización de Medicamentos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- Header -->
<?php include('includes/header.php'); ?>

<!-- Menu -->
<?php include('includes/menu.php'); ?>

<div class="container mt-5">
    <h2>Solicitudes Pendientes de Autorización</h2>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th>ID Solicitud</th>
            <th>Paciente</th>
            <th>Medicamento</th>
            <th>Cantidad</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($solicitud = $solicitudesPendientes->fetch_assoc()): ?>
            <tr>
                <td><?= $solicitud['id_solicitud']; ?></td>
                <td><?= $solicitud['paciente']; ?></td>
                <td><?= $solicitud['medicamento']; ?></td>
                <td><?= $solicitud['cantidad']; ?></td>
                <td><?= $solicitud['estado']; ?></td>
                <td>
                    <form action="controladores/autorizar_medicamento.php" method="POST" class="d-inline">
                        <input type="hidden" name="id_solicitud" value="<?= $solicitud['id_solicitud']; ?>">
                        <select name="estado" class="form-control" required>
                            <option value="autorizada">Autorizar</option>
                            <option value="rechazada">Rechazar</option>
                        </select>
                        <button type="submit" class="btn btn-success mt-2">Actualizar</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Footer -->
<?php include('includes/footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
