<?php
// Iniciar sesión si no se ha iniciado aún
session_start();

// Verificar si el usuario no está autenticado
if (!isset($_SESSION['usuario_autenticado'])) {
    // El usuario no está autenticado, redirigirlo a la página de inicio de sesión
    header("Location: login.php");
    exit();
}


require_once('../models/historiaclinicamodel.php');  // Modelo para gestionar la historia clínica

$historiaClinicaModel = new HistoriaClinicaModel();

// Obtener la historia clínica y los diagnósticos asociados
$historiaClinica = $historiaClinicaModel->obtenerHistoriaClinicaConDiagnosticos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Historia Clínica</title>
 <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../public/panel.css">
  <link rel="icon" href="../dist/img/logo.ico">
  <link rel="stylesheet" href="../dist/css/style_MediFast.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <?php include('../shared/menuadmin.php'); ?> 

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestión de Historia Clínica</h1>
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
                <h3 class="card-title">Historia Clínica del Paciente</h3>
              </div>
              <div class="card-body">
                <table id="historia_clinica_table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>ID Historia</th>
                      <th>Paciente</th>
                      <th>Fecha Diagnóstico</th>
                      <th>Tipo Diagnóstico</th>
                      <th>Resultado</th>
                      <th>Descripción</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($historiaClinica as $diagnostico): ?>
                      <tr>
                        <td><?php echo $diagnostico['historia_clinica_id']; ?></td>
                        <td><?php echo $diagnostico['nombre_paciente']; ?></td>
                        <td><?php echo $diagnostico['fecha']; ?></td>
                        <td><?php echo $diagnostico['tipo']; ?></td>
                        <td><?php echo $diagnostico['resultado']; ?></td>
                        <td><?php echo $diagnostico['descripcion']; ?></td>
                        <td>
                          <button class="btn btn-primary editar-diagnostico" data-id="<?php echo $diagnostico['diagnostico_id']; ?>">Editar</button>
                          <button class="btn btn-danger eliminar-diagnostico" data-id="<?php echo $diagnostico['diagnostico_id']; ?>">Eliminar</button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
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
<script src="../js/usuarios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $('#historia_clinica_table').DataTable({
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