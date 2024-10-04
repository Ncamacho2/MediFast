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
<html lang="en">

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
              <h1>Crear usuarios</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <form class="form" action="../controllers/loginController.php" method="post">
          <div class="card card-default">
            <div class="card-body">
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del usuario" required>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese el email del usuario" required>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label for="rol">Rol:</label>
                    <select class="form-control" id="rol" name="rol">
                      <option value="Gerencia">Gerencia</option>
                      <option value="Administrador">Administrador</option>
                      <!-- Agrega más opciones según necesites -->
                    </select>
                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese el teléfono del usuario" required>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese la contraseña del usuario" required>
                  </div>
                  <!-- /.form-group -->
                  <!-- Otros campos del formulario según tus necesidades -->
                </div>

                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary" id="guardarUsuario">Guardar</button>
          </div>
          <!-- /.card-body -->
    </div>
    </form>
    <!-- /.container-fluid -->
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
</body>

</html>