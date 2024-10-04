<?php
    session_start();

    // Incluir el modelo de usuarios
    require_once('../models/usuariosmodel.php');

    // Verificar si se recibió la acción
    if(isset($_POST['action'])) {
        $action = $_POST['action'];

        // Instanciar el modelo de usuarios
        $usuariosModel = new UsuariosModel();

        // Ejecutar la acción correspondiente
        switch ($action) {
            case 'obtenerUsuario':
                obtenerUsuario($usuariosModel);
                break;
            case 'eliminarUsuario':
                eliminarUsuario($usuariosModel);
                break;
            case 'editarUsuario': // Agregar el caso para la acción de editar usuario
                editarUsuario($usuariosModel);
                break; 
            case 'guardarUsuario': // Agregar el caso para la acción de editar usuario
                guardarUsuario($usuariosModel);
                break;        
            // Agregar más casos para otras acciones si es necesario
            default:
                echo json_encode(array("success" => false, "message" => "Acción no válida."));
        }
    } else {
        // Si no se recibió ninguna acción, devolver un mensaje de error en formato JSON
        echo json_encode(array("success" => false, "message" => "No se recibió ninguna acción."));
    }

    function obtenerUsuario($usuariosModel) {
        // Verificar si se recibió el ID del usuario
        if(isset($_POST['id'])) {
            // Obtener el ID del usuario desde la solicitud POST
            $usuarioId = $_POST['id'];
            
            // Instanciar el modelo de usuarios
            $usuariosModel = new UsuariosModel();

            // Obtener la información del usuario por su ID
            $usuario = $usuariosModel->obtenerUsuarioPorId($usuarioId);

            // Verificar si se encontró la información del usuario
            if ($usuario !== null) {
                // Devolver la información del usuario en formato JSON
                echo json_encode(array("success" => true, "usuario" => $usuario));
            } else {
                // Si no se encontró la información del usuario, devolver un mensaje de error en formato JSON
                echo json_encode(array("success" => false, "message" => "No se encontró la información del usuario."));
            }
        } else {
            // Si no se recibió el ID del usuario en la solicitud POST, devolver un mensaje de error en formato JSON
            echo json_encode(array("success" => false, "message" => "No se recibió el ID del usuario."));
        }
    }

    function eliminarUsuario($usuariosModel) {
        // Verificar si se recibió el ID del usuario
        if(isset($_POST['id'])) {
            // Obtener el ID del usuario desde la solicitud POST
            $usuarioId = $_POST['id'];
    
            // Intentar eliminar al usuario por su ID
            $eliminado = $usuariosModel->eliminarUsuario($usuarioId);
    
            // Verificar si el usuario fue eliminado correctamente
            if ($eliminado) {
                // Devolver un mensaje de éxito en formato JSON
                echo json_encode(array("success" => true, "message" => "Usuario eliminado correctamente."));
            } else {
                // Si no se pudo eliminar al usuario, devolver un mensaje de error en formato JSON
                echo json_encode(array("success" => false, "message" => "No se pudo eliminar al usuario."));
            }
        } else {
            // Si no se recibió el ID del usuario en la solicitud POST, devolver un mensaje de error en formato JSON
            echo json_encode(array("success" => false, "message" => "No se recibió el ID del usuario."));
        }
    }    

    // Función para editar usuario
    function editarUsuario($usuariosModel) {
        // Verificar si se recibieron los datos del formulario
        if(isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['rol']) && isset($_POST['telefono']) && isset($_POST['password'])) {
            // Obtener los datos del formulario
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $rol = $_POST['rol'];
            $telefono = $_POST['telefono'];
            $password = $_POST['password']; // Ajusta esto según tus necesidades

            // Instanciar el modelo de usuarios
            $usuariosModel = new UsuariosModel();

            // Intentar actualizar el usuario en la base de datos
            $actualizacionExitosa = $usuariosModel->actualizarUsuario($id, $nombre, $email, $rol, $telefono, $password);

            // Verificar si la actualización fue exitosa
            if ($actualizacionExitosa) {
                // Devolver una respuesta de éxito en formato JSON
                echo json_encode(array("success" => true));
            } else {
                // Devolver un mensaje de error en formato JSON
                echo json_encode(array("success" => false, "message" => "Error al actualizar el usuario."));
            }
        } else {
            // Si no se recibieron todos los datos necesarios, devolver un mensaje de error en formato JSON
            echo json_encode(array("success" => false, "message" => "No se recibieron todos los datos necesarios para actualizar el usuario."));
        } 
    }   
    
    // Función para crear usuario
    function guardarUsuario($usuariosModel) {
        // Obtener los datos del formulario
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $rol = $_POST["rol"];
        $telefono = $_POST["telefono"];
        $password = $_POST["password"]; // Recuerda cifrar la contraseña antes de almacenarla en la base de datos

        // Instanciar el modelo de usuarios
        $usuariosModel = new UsuariosModel();

        // Intentar crear el usuario en la base de datos
        $creado = $usuariosModel->crearUsuario($nombre, $email, $rol, $telefono, $password);

        // Verificar si el usuario fue creado correctamente
        if ($creado) {
            // Devolver un mensaje de éxito en formato JSON
            $response = array("success" => true, "message" => "Usuario creado exitosamente");
            echo json_encode($response);
        } else {
            // Si ocurrió algún error durante la creación, devolver un mensaje de error en formato JSON
            $response = array("success" => false, "message" => "Error al crear usuario");
            echo json_encode($response);
        }
    }

?>
