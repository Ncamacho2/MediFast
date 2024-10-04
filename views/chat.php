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
  <style>
        #chatMessages {
            border: 1px solid #ccc;
            height: 300px;
            overflow-y: scroll;
            padding: 10px;
            margin-bottom: 10px;
        }
        .message {
            margin-bottom: 10px;
        }
        .message .from-paciente {
            text-align: right;
        }
    </style>
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
<?php include('../shared/menuadmin.php'); ?> 

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Chat</h1>
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
              </div>
            <div class="card-body">

<div class="container mt-5 table table-striped table-bordered table-hover table-responsive">
    <h2>Chat Paciente</h2>
    <div id="chatMessages">
        <!-- Mensajes del chat se mostrarán aquí -->
    </div>
    <div class="input-group">
        <input type="text" id="messageInput" class="form-control" placeholder="Escribe tu mensaje...">
        <div class="input-group-append">
            <button id="sendMessage" class="btn btn-primary">Enviar</button>
        </div>
    </div>
</div>
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
<script>
    // Respuestas aleatorias predefinidas
    const respuestas = [
        "Hola, ¿en qué puedo ayudarte?",
        "Gracias por tu mensaje, un momento por favor.",
        "Estoy revisando tu solicitud.",
        "Te contactaré pronto con más detalles.",
        "No tengo esa información en este momento.",
        "Por favor, consulta con el área administrativa.",
        "Necesitaría más detalles para ayudarte.",
        "Tu consulta ha sido recibida, estamos trabajando en ella."
    ];

    // Función para enviar el mensaje del paciente
    document.getElementById('sendMessage').addEventListener('click', function() {
        const messageInput = document.getElementById('messageInput');
        const chatMessages = document.getElementById('chatMessages');

        if (messageInput.value.trim() !== "") {
            // Mostrar el mensaje del paciente
            const pacienteMessage = document.createElement('div');
            pacienteMessage.classList.add('message', 'from-paciente');
            pacienteMessage.innerHTML = `<strong>Tú:</strong> ${messageInput.value}`;
            chatMessages.appendChild(pacienteMessage);

            // Desplazar hacia abajo para ver el último mensaje
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Limpiar el campo de texto
            messageInput.value = '';

            // Responder con un mensaje aleatorio después de un retraso de 1 segundo
            setTimeout(function() {
                const respuestaAleatoria = respuestas[Math.floor(Math.random() * respuestas.length)];
                const sistemaMessage = document.createElement('div');
                sistemaMessage.classList.add('message', 'from-sistema');
                sistemaMessage.innerHTML = `<strong>Sistema:</strong> ${respuestaAleatoria}`;
                chatMessages.appendChild(sistemaMessage);

                // Desplazar hacia abajo para ver el último mensaje
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 1000);
        }
    });
</script>

</body>
</html>
