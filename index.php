<?php
// Redirige automáticamente al usuario a la página de inicio de sesión al acceder al index.php
header("Location: views/login.php");
exit; // Asegura que el script se detenga después de redirigir
?>
