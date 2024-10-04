<?php
session_start();
if (!isset($_SESSION['usuario_autenticado'])) {
    header("Location: login.php");
    exit();
}

require_once('../models/citasmodel.php');
require_once('../models/usuariosmodel.php'); // Modelo para obtener los usuarios (pacientes y médicos)

$citasModel = new CitasModel();
$usuarioModel = new UsuariosModel(); // Usar el modelo de usuarios

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $pacienteId = $_POST['paciente_id'];
    $medicoId = $_POST['medico_id'];
    $estado = 'Pendiente';

    // Crear una nueva cita usando el modelo
    if ($citasModel->crearCita($fecha, $hora, $pacienteId, $medicoId, $estado)) {
        $mensaje_exito = "Cita médica creada exitosamente";
    } else {
        $mensaje_error = "Error al crear la cita médica";
    }
}

// Obtener los pacientes y médicos desde la base de datos
$pacientes = $usuarioModel->obtenerPacientes();
$medicos = $usuarioModel->obtenerMedicosConEspecialidad();

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Crear Cita Médica</title>
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="icon" href="../dist/img/Logo.ico">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <?php include('../shared/menuadmin.php'); ?> 

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Crear Nueva Cita Médica</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Formulario para crear una cita médica</h3>
              </div>

              <div class="card-body">
                <?php if (isset($mensaje_exito)): ?>
                  <div class="alert alert-success"><?php echo $mensaje_exito; ?></div>
                <?php endif; ?>

                <?php if (isset($mensaje_error)): ?>
                  <div class="alert alert-danger"><?php echo $mensaje_error; ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                  <div class="form-group">
                    <label for="fecha">Fecha de la Cita:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label for="hora">Hora de la Cita:</label>
                    <input type="time" name="hora" id="hora" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label for="paciente_id">Seleccionar Paciente:</label>
                    <select name="paciente_id" id="paciente_id" class="form-control" required>
                      <option value="">Seleccionar Paciente</option>
                      <?php foreach ($pacientes as $paciente): ?>
                        <option value="<?php echo $paciente['ID_usuario']; ?>"><?php echo $paciente['Nombre_usuario']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group">
    <label for="medico_id">Seleccionar Médico:</label>
    <select name="medico_id" id="medico_id" class="form-control" required>
        <option value="">Seleccionar Médico</option>
        <?php foreach ($medicos as $medico): ?>
            <option value="<?php echo $medico['ID_usuario']; ?>">
                <?php echo $medico['Nombre_usuario'] . " - " . $medico['especialidad']; ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

                  <button type="submit" class="btn btn-success">Crear Cita</button>
                  <a href="gestionar_citas.php" class="btn btn-secondary">Cancelar</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

</div>
 <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Usuarios  & Plugins -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../plugins/jszip/jszip.min.js"></script>
  <script src="../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!--tuinventory JS-->
  <script src="../js/citas.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>
