<?php
// Iniciar sesión si no se ha iniciado aún
session_start();

// Verificar si el usuario no está autenticado
if (!isset($_SESSION['usuario_autenticado'])) {
    // El usuario no está autenticado, redirigirlo a la página de inicio de sesión
    header("Location: login.php");
    exit();
}

// Incluir el modelo para interactuar con la base de datos
require_once('../models/citasmodel.php');

// Instanciar el modelo
$citasModel = new citasmodel();

// Obtener información del usuario logueado
$nombreUsuario = $_SESSION['nombre_usuario']; 

// Obtener todas las citas de la base de datos
$citas = $citasModel->obtenerCitas();

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MediFast | Citas Médicas</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="icon" href="../dist/img/logo.ico">
  <link rel="stylesheet" href="../dist/css/style_MediFast.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <?php include('../shared/menuadmin.php'); ?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Citas Médicas</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Citas Médicas programadas en el sistema</h3>
                <a href="crearcita.php" class="btn btn-primary float-right">Programar Cita</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="citas_table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>ID Cita</th>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Paciente</th>
                      <th>Médico</th>
                      <th>Estado</th>
                      <th>Administrar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($citas as $cita): ?>
                      <tr>
                        <td><?php echo $cita['cita_id']; ?></td>
                        <td><?php echo $cita['fecha']; ?></td>
                        <td><?php echo $cita['hora']; ?></td>
                        <td><?php echo $cita['nombre_paciente']; ?></td>
                        <td><?php echo $cita['nombre_medico']; ?></td>
                        <td><?php echo $cita['estado']; ?></td>
                        <td>
                          <button class="btn btn-primary editar-cita" data-id="<?php echo $cita['cita_id']; ?>">Editar</button>
                          <button class="btn btn-danger eliminar-cita" data-id="<?php echo $cita['cita_id']; ?>">Eliminar</button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!--Modal Editar-->
      <!-- Modal para editar la cita -->
<div class="modal fade" id="editarCitaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Cita Médica</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editarCitaForm">
          <input type="hidden" name="cita_id" id="cita_id">
          <div class="form-group">
            <label for="fecha">Fecha de la Cita:</label>
            <input type="date" name="fecha" id="fecha" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="hora">Hora de la Cita:</label>
            <input type="time" name="hora" id="hora" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="estado">Estado de la Cita:</label>
            <select name="estado" id="estado" class="form-control" required>
              <option value="Pendiente">Pendiente</option>
              <option value="Confirmada">Confirmada</option>
              <option value="Cancelada">Cancelada</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

    <!-- /.modal -->
    </section>
    <!-- /.content -->
  </div>
   <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include('../shared/footer.php'); ?>
  <!-- /.content-wrapper -->
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

<!-- Page specific script -->
<script>
  $(function () {
    $('#citas_table').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json" // Cambia a tu idioma preferido
      }
    });
  });
</script>
</body>
</html>