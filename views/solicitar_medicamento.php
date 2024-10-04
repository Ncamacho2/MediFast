<?php
session_start();
require_once('../models/config.php');
require_once('../models/medicamentomodel.php');

$medicamentoModel = new MedicamentoModel($conexion);

// Obtener los medicamentos prescritos al paciente
$idPaciente = $_SESSION['ID_usuario'];
$medicamentosRecetados = $medicamentoModel->obtenerMedicamentosRecetados($idPaciente);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Medicamentos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- Header -->
<?php include('includes/header.php'); ?>

<!-- Menu -->
<?php include('includes/menu.php'); ?>

<div class="container mt-5">
    <h2>Solicitar Medicamentos</h2>

    <form action="controladores/solicitar_medicamento.php" method="POST">
        <div class="form-group">
            <label for="medicamento">Medicamentos Disponibles:</label>
            <select name="id_medicamento" class="form-control" required>
                <?php while ($medicamento = $medicamentosRecetados->fetch_assoc()): ?>
                    <option value="<?= $medicamento['id_medicamento']; ?>">
                        <?= $medicamento['nombre'] ?> - Disponibles: <?= $medicamento['cantidad']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Solicitar</button>
    </form>
</div>

<!-- Footer -->
<?php include('includes/footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
