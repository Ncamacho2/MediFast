  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <p class="brand-link">
      <img src="../dist/img/Logo.png" alt="Logo tuinventory" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MediFast</span>
    </p>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/avatarpro.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <!-- Mostrar el nombre del usuario si está logueado -->
          <?php if ($nombreUsuario) : ?>
            <?php echo $nombreUsuario; ?>
          <?php else : ?>
            <a href="#" class="d-block">Usuario no identificado</a>
          <?php endif; ?>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="../views/panel_admin.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../views/usuarios.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../views/gestionar_citas.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Gestionar citas médicas
              </p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="../views/gestionar_historia_clinica.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Historia clinica
              </p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="../views/chat.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Chat
              </p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="../views/gestionar_resultados.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Resultados
              </p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="../views/solicitudes_medicamentos.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Medicamentos
              </p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="../controllers/logoutcontroller.php" class="nav-link">
              <i class="nav-icon fas fa-door-open"></i>
              <p>Salir</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>