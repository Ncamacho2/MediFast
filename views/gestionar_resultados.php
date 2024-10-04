<?php
// Iniciar sesión si no se ha iniciado aún
session_start();

// Verificar si el usuario no está autenticado
if (!isset($_SESSION['usuario_autenticado'])) {
    // El usuario no está autenticado, redirigirlo a la página de inicio de sesión
    header("Location: login.php");
    exit();
}

require_once('../models/config.php');  
require_once('../models/resultadosmodel.php');  // Modelo para gestionar la historia clínica

// Incluir el modelo para interactuar con la base de datos
require_once('../models/usuariosmodel.php');

// Instanciar el modelo
$usuariosModel = new usuariosmodel();

// Obtener información del usuario logueado
$nombreUsuario = $_SESSION['nombre_usuario']; // Traigo la información del campo llamado 'Nombre_usuario'
// Si el usuario está autenticado, continúa mostrando el contenido de la página...

$conexion = conectarBaseDatos();
$resultadosModel = new ResultadosModel($conexion);

// Obtener la historia clínica y los diagnósticos asociados
$resultados = $resultadosModel->obtenerTodosLosResultados();
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
          <h1>Gestión de Resultados de Exámenes</h1>
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
              <h3 class="card-title">Resultados de Exámenes</h3>
              <!-- Botón para agregar un nuevo resultado -->
              <a href="formulario_resultado.php" class="btn btn-primary float-right">Agregar Resultado</a>
            </div>
            <div class="card-body">
              <table id="resultados_table" class="table table-striped table-bordered table-hover table-responsive">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Diagnóstico</th>
                    <th>Tipo de Examen</th>
                    <th>Descripción del Resultado</th>
                    <th>Fecha del Examen</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody >
                <?php foreach ($resultados as $row): ?>
                    <tr>
                      <td><?php echo $row['id_resultado']; ?></td>
                      <td><?php echo $row['nombre_paciente']; ?></td>
                      <td><?php echo $row['diagnostico_descripcion']; ?></td>
                      <td><?php echo $row['tipo_examen']; ?></td>
                      <td><?php echo $row['resultado_descripcion']; ?></td>
                      <td><?php echo $row['fecha_examen']; ?></td>
                      <td><?php echo $row['observaciones']; ?></td>
                      <td>
                        <button class="btn btn-danger eliminar-resultado" data-id="<?php echo $row['id_resultado']; ?>">Eliminar</button>
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
<script src="../js/resultados.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $('#resultados_table').DataTable({
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
