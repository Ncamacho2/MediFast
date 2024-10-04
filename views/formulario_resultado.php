<?php
require_once('../models/config.php');

// Conexión a la base de datos
$conexion = conectarBaseDatos();

// Obtener todos los pacientes de la base de datos
$consultaPacientes = " SELECT p.paciente_id, u.Nombre_usuario 
    FROM t_paciente p
    JOIN t_usuarios u ON p.paciente_id = u.ID_usuario";

$resultadoPacientes = $conexion->query($consultaPacientes);
?>

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
require_once('../models/usuariosmodel.php');

// Instanciar el modelo
$usuariosModel = new usuariosmodel();

// Obtener información del usuario logueado
$nombreUsuario = $_SESSION['nombre_usuario']; // Traigo la información del campo llamado 'Nombre_usuario'
// Si el usuario está autenticado, continúa mostrando el contenido de la página...

// Obtener todos los usuarios de la base de datos
$usuarios = $usuariosModel->obtenerUsuarios();

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>tuinventori | Usuarios</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../public/panel.css">
  <link rel="icon" href="../dist/img/favicontuinventory.png">
  <!--Style Meingel-->
<link rel="stylesheet" href="../dist/css/style_Tuinventory.css">


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
              <h1>Crear Resultado de Examen</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Agregar Resultado de Examen</h3>
            </div>
            <div class="card-body">
              <form id="agregarResultadoForm">
                <div class="form-group">
                  <label for="paciente">Seleccionar Paciente:</label>
                  <select name="paciente_id" id="paciente" class="form-control" required>
                    <option value="">Seleccionar Paciente</option>
                    <?php while ($paciente = $resultadoPacientes->fetch_assoc()): ?>
                      <option value="<?php echo $paciente['paciente_id']; ?>"><?php echo $paciente['Nombre_usuario']; ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="diagnostico">Seleccionar Diagnóstico:</label>
                  <select name="diagnostico_id" id="diagnostico" class="form-control" required>
                    <option value="">Seleccionar Diagnóstico</option>
                    <!-- Los diagnósticos se cargarán aquí mediante AJAX -->
                  </select>
                </div>

                <div class="form-group">
                  <label for="tipo_examen">Tipo de Examen:</label>
                  <select name="tipo_examen" id="tipo_examen" class="form-control" required>
                    <option value="">Seleccionar Tipo de Examen</option>
                    <option value="Sangre">Sangre</option>
                    <option value="Radiografía">Radiografía</option>
                    <option value="Tomografía">Tomografía</option>
                    <option value="Electrocardiograma">Electrocardiograma</option>
                    <option value="Ecografía">Ecografía</option>
                    <option value="Resonancia Magnética">Resonancia Magnética</option>
                    <option value="Prueba de Esfuerzo">Prueba de Esfuerzo</option>
                    <option value="Colonoscopia">Colonoscopia</option>
                    <option value="Audiometría">Audiometría</option>
                    <option value="Examen de Vista">Examen de Vista</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="descripcion">Descripción:</label>
                  <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
                </div>
                
                <div class="form-group">
                  <label for="fecha_examen">Fecha del Examen:</label>
                  <input type="date" name="fecha_examen" id="fecha_examen" class="form-control" required>
                </div>

                <div class="form-group">
                  <label for="observaciones">Observaciones (Opcional):</label>
                  <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Resultado</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


      <!-- Main Footer -->
      <?php include('../shared/footer.php'); ?>
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
<script>
  $(document).ready(function() {
    // Cargar los diagnósticos cuando se selecciona un paciente
    $('#paciente').on('change', function() {
      var pacienteId = $(this).val();
      
      if (pacienteId) {
        $.ajax({
          url: '../diagnosticos/cargar_diagnosticos.php',
          type: 'POST',
          data: { paciente_id: pacienteId },
          success: function(response) {
            $('#diagnostico').html(response);
          }
        });
      } else {
        $('#diagnostico').html('<option value="">Seleccionar Diagnóstico</option>');
      }
    });

    // Enviar el formulario de agregar resultado
    $('#agregarResultadoForm').on('submit', function(e) {
      e.preventDefault();
      var formData = $(this).serialize();
      
      $.ajax({
        url: '../resultados/agregar_resultado.php',
        type: 'POST',
        data: formData,
        success: function(response) {
          var resultado = JSON.parse(response);
          if (resultado.success) {
            Swal.fire(
              '¡Guardado!',
              'El resultado ha sido guardado exitosamente.',
              'success'
            ).then(() => {
              window.location.href = 'gestionar_resultados.php'; // Redirigir después del éxito
            });
          } else {
            Swal.fire(
              'Error!',
              resultado.message,  // Mostrar el mensaje de error proporcionado por el backend
              'error'
            );
          }
        }
      });
    });
  });
</script>
</body>
</html>
