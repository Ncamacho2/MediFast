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
require_once('../models/loginmodel.php');

// Instanciar el modelo
$loginModel = new LoginModel();

// Obtener información del usuario logueado
$nombreUsuario = $_SESSION['nombre_usuario']; // Traigo la información del campo llamado 'Nombre_usuario'
// Si el usuario está autenticado, continúa mostrando el contenido de la página...

// Obtener el rol del usuario desde la sesión
$rol_usuario = $_SESSION['rol_usuario'];

// Incluir el menú correspondiente según el rol del usuario
if ($rol_usuario == 'sysadmin' || $rol_usuario == 'gerencia') {
    include('../shared/menuadmin.php');
} else {
    include('../shared/menu.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MediFast | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../public/panel.css">
  <link rel="icon" href="../dist/img/medifast.ico">
  <link rel="stylesheet" href="../dist/css/style_MediFast.css">
  
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="../dist/img/Logo.png" alt="Logo" height="60" width="60">
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Noticias</h1>
            </div>
          </div>
        </div>
      </div>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><a href="calc.php" class='herramientas' onclick="openPopup('calc.php', 'Calculadora', 400, 600); return false;"><i class="fas fa-calculator"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Eventos</span>
                  </a>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">

              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">

              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">

              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <?php include('../shared/footer.php'); ?>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>
  <!-- meingel -->
  <script src="../js/herramientas.js"></script>


  <!-- PAGE ../plugins -->
  <!-- jQuery Mapael -->
  <script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="../plugins/raphael/raphael.min.js"></script>
  <script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="../plugins/chart.js/Chart.min.js"></script>
</body>

</html>