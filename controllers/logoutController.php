<?php
// Iniciar sesión si aún no se ha iniciado
session_start();

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión
header("Location: ../views/login.php");
exit();
?>
