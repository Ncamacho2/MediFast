<?php
function verificarPermisos($fechaTransaccion) {
    session_start();

    // Verificar si el usuario está logueado
    if (!isset($_SESSION['usuario_autenticado'])) {
        header('Location: login.php');
        exit();
    }

    // Obtener el rol del usuario desde la sesión
    $rol_usuario = $_SESSION['rol_usuario'];
    $fechaActual = date('Y-m-d');

    // Permisos por rol
    $permisos = [
        'Administrador' => ['ver', 'editar'],
        'sysadmin' => ['ver', 'editar', 'eliminar'],
        'Gerencia' => ['ver', 'editar', 'eliminar']
    ];

    // Verificar permiso de edición y fecha de transacción para administradores
    if ($rol_usuario === 'Administrador' && $fechaTransaccion !== $fechaActual) {
        header('Location: ../views/no_permitido.php');
        exit();
    }

    // Verificar que el rol tenga permiso para editar
    if (!in_array('editar', $permisos[$rol_usuario])) {
        header('Location: ../views/no_permitido.php');
        exit();
    }

    // Verificar que el rol tenga permiso para eliminar
    if (!in_array('eliminar', $permisos[$rol_usuario])) {
        header('Location: ../views/no_permitido.php');
        exit();
    }
}
?>
