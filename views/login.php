<?php
// Iniciar sesión si no se ha iniciado aún
session_start();

// Cerrar la sesión si el usuario ya está autenticado
if (isset($_SESSION['usuario_autenticado'])) {
    // Destruir todas las variables de sesión
    $_SESSION = array();

    // Finalizar la sesión
    session_destroy();
}

// Verificar si hay un parámetro de error en la URL
$error_message = '';
if (isset($_GET['error']) && $_GET['error'] === 'credenciales') {
    // Establecer el mensaje de error
    $error_message = "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
}

?>
<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <title>MediFast - Iniciar sesión</title>

    <link rel="stylesheet" href="../public/login.css">
    <link rel="icon" href="../dist/img/favicon.ico">
    

</head>

<body>

    <section> 

        <div class="signin">

            <div class="content">

                <img class="logotipo" src="../dist/img/Logo.png" alt="Logo">

                <div class="form">
                    <form class="form" action="../controllers/loginController.php" method="post">
                        <div class="inputBox">

                            <input type="text" name="nombre_usuario" required> <i>Nombre de usuari@</i>

                        </div>

                        <div class="inputBox">

                            <input type="password" name="contraseña" required> <i>Contraseña</i>

                        </div>

                        <div class="links"> <!--<a href="#">Olvidaste tu contraseña?</a>-->

                        </div>

                        <div class="inputBox">

                            <input type="submit" value="Ingresar">

                        </div>
                        <div id="error-message" style="color: #fff;"><?php echo $error_message; ?></div>
                    </form>

                </div>

            </div>

        </div>

    </section>

</body>

</html>