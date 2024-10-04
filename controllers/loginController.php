<?php
    // Iniciar sesión si aún no se ha iniciado
    session_start();

    // Verificar si el usuario ya está autenticado, si es así, redirigirlo a la página de panel
    if (isset($_SESSION['usuario_autenticado'])) {
        header("Location: ../views/panel.php");
        exit();
    }

    // Incluir el modelo para interactuar con la base de datos
    require_once('../models/loginmodel.php');

    // Verificar si se han enviado datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperar los datos del formulario
        $nombre_usuario = $_POST['nombre_usuario'];
        $contraseña = $_POST['contraseña'];

        // Instanciar el modelo
        $loginModel = new LoginModel();

        // Verificar las credenciales
        $resultado = $loginModel->verificarCredenciales($nombre_usuario, $contraseña);

        if ($resultado) {
            // Las credenciales son válidas, establecer la sesión y redirigir según el rol del usuario
            $_SESSION['usuario_autenticado'] = true;

            // Obtener el nombre de usuario y almacenarlo en la sesión
            $_SESSION['nombre_usuario'] = $nombre_usuario;

            // Debug: Verificar si el nombre de usuario se ha almacenado correctamente
            var_dump($_SESSION['nombre_usuario']);


            // Redirigir según el rol del usuario
            if ($_SESSION['rol_usuario'] == "sysadmin" || $_SESSION['rol_usuario'] == "Gerencia") {
                header("Location: ../views/panel_admin.php");
                exit();
            } else {
                header("Location: ../views/panel.php");
                exit();
            }
        } else {
            // Las credenciales son inválidas, redirigir a la página de inicio de sesión con un parámetro de error
            header("Location: ../views/login.php?error=credenciales");
            exit();
        }
    }
?>