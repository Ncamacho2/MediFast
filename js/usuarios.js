$(document).ready(function() {
  // Función para cargar la información del usuario seleccionado en el modal de edición
  $('.editar-usuario').click(function() {
      var usuarioId = $(this).data('id');

      // Realizar una petición AJAX para obtener la información del usuario con el ID usuarioId
      $.ajax({
          url: '../controllers/usuariosController.php', // Ruta al script PHP que obtiene la información del usuario
          method: 'POST',
          data: { id: usuarioId, action: 'obtenerUsuario' }, // Enviar el ID del usuario al servidor
          dataType: 'json',
          success: function(response) {
              // Verificar si se obtuvo la información del usuario correctamente
              if (response.success) {
                  var usuario = response.usuario;

                  // Llenar el formulario con la información del usuario
                  $('#usuarioId').val(usuario.ID_usuario);
                  $('#nombre').val(usuario.Nombre_usuario);
                  $('#email').val(usuario.Email_usuario);
                  $('#rol').val(usuario.Rol_usuario);
                  $('#telefono').val(usuario.Telefono_usuario);
                  $('#password').val(usuario.Password_usuario);
                  // Puedes agregar más campos según tu base de datos

                  // Abrir el modal de edición
                  $('#editarUsuarioModal').modal('show');
              } else {
                  // Mostrar un mensaje de error si no se pudo obtener la información del usuario
                  console.log('Error al obtener la información del usuario');
              }
          },
          error: function(xhr, status, error) {
              // Manejar errores de la petición AJAX
              console.error('Error en la petición AJAX:', error);
          }
      });
  });

  // Acción cuando el modal se cierre por completo
  $('#crearEditarUsuarioModal').on('hidden.bs.modal', function() {
      // Limpiar los campos del formulario
      $("#crearEditarUsuarioForm")[0].reset();
  });
                                                
  /// Función para guardar los cambios realizados en el formulario de edición
  $('#guardarCambios').click(function() {
    // Obtener los datos del formulario de edición
    var usuarioId = $('#usuarioId').val();
    var nombre = $('#nombre').val();
    var email = $('#email').val();
    var rol = $('#rol').val();
    var telefono = $('#telefono').val();
    var password = $('#password').val(); // Si deseas actualizar la contraseña también

    // Verificar si la contraseña está vacía
    if (password.trim() === '') {
        // Si la contraseña está vacía, eliminarla de los datos a enviar
        password = null;
    }

    // Realizar una petición AJAX para enviar los datos del formulario de edición al servidor
    $.ajax({
        url: '../controllers/usuariosController.php', // Ruta al script PHP para guardar los cambios
        method: 'POST',
        data: { 
            id: usuarioId,
            nombre: nombre,
            email: email,
            rol: rol,
            telefono: telefono,
            password: password ,// Si deseas actualizar la contraseña también
            action: 'editarUsuario' //Accion para editar usuario
        },
        dataType: 'json',
        success: function(response) {
            // Verificar si se guardaron los cambios correctamente
            if (response.success) {
                // Mostrar un cuadro de diálogo de éxito con SweetAlert2
                Swal.fire(
                    '¡Actualizado!',
                    'Cambios guardados exitosamente',
                    'success'
                ).then(() => {
                    // Recargar la página para actualizar la lista de usuarios
                    location.reload();
                });
            } else {
                // Mostrar un mensaje de error si no se pudieron guardar los cambios
                console.log('Error al guardar los cambios');
            }
        },
        error: function(xhr, status, error) {
            // Manejar errores de la petición AJAX
            console.error('Error en la petición AJAX:', error);
        }
    });

    // Cerrar el modal de edición
    $('#editarUsuarioModal').modal('hide');
});

  // Función para cargar la información del usuario seleccionado en el modal de edición
  $('.eliminar-usuario').click(function() {
      // Obtener el ID del usuario a eliminar
      var usuarioId = $(this).data('id');

      // Mostrar un cuadro de diálogo de confirmación al usuario usando SweetAlert2
      Swal.fire({
          title: '¿Estás seguro?',
          text: "Esta acción no se puede deshacer",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Sí, eliminar usuario',
          cancelButtonText: 'Cancelar'
      }).then((result) => {
          if (result.isConfirmed) {
              // Realizar una petición AJAX para eliminar el usuario
              $.ajax({
                  url: '../controllers/usuariosController.php', // Ruta al script PHP que elimina el usuario
                  method: 'POST',
                  data: { id: usuarioId, action: 'eliminarUsuario'  }, // Enviar el ID del usuario al servidor
                  dataType: 'json',
                  success: function(response) {
                      // Verificar si la eliminación fue exitosa
                      if (response.success) {
                          // Mostrar un cuadro de diálogo de éxito con SweetAlert2
                          Swal.fire(
                              '¡Eliminado!',
                              'El usuario ha sido eliminado.',
                              'success'
                          ).then(() => {
                              // Recargar la página para actualizar la lista de usuarios
                              location.reload();
                          });
                      } else {
                          // Mostrar un cuadro de diálogo de error con SweetAlert2
                          Swal.fire(
                              'Error',
                              'No se pudo eliminar el usuario.',
                              'error'
                          );
                      }
                  },
                  error: function(xhr, status, error) {
                      // Manejar errores de la petición AJAX
                      console.error('Error en la petición AJAX:', error);
                      // Mostrar un cuadro de diálogo de error genérico con SweetAlert2
                      Swal.fire(
                          'Error',
                          'Se produjo un error al intentar eliminar el usuario.',
                          'error'
                      );
                  }
              });
          }
      });
  });  

  $("#guardarUsuario").click(function(event) {
    event.preventDefault(); // Previene el comportamiento predeterminado del botón

    // Obtener los valores de los campos del formulario
    var nombre = $("#nombre").val();
    var email = $("#email").val();
    var rol = $("#rol").val();
    var telefono = $("#telefono").val();
    var password = $("#password").val();

    // Validar que los campos no estén vacíos
    if (nombre === '' || email === '' || password === '') {
        // Mostrar un mensaje de error con SweetAlert2
        Swal.fire({
            icon: 'error',
            title: 'Campos vacíos',
            text: 'Por favor, completa todos los campos antes de continuar.',
            showConfirmButton: true
        });
        return; // Detener la ejecución de la función si hay campos vacíos
    }

    // Realizar la petición AJAX para crear el usuario
    $.ajax({
        url: "../controllers/usuariosController.php", // Ruta al archivo PHP que maneja la creación de usuario
        type: "POST",
        data: {
            nombre: nombre,
            email: email,
            rol: rol,
            telefono: telefono,
            password: password,
            action: 'guardarUsuario'
        },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                // Si la creación fue exitosa, mostrar mensaje de éxito con SweetAlert2
                Swal.fire({
                    icon: 'success',
                    title: 'Usuario creado exitosamente',
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Recargar la página después de que el mensaje se cierre
                        location.reload();
                    }
                });
            } else {
                // Si hubo un error, mostrar mensaje de error con SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Error al crear usuario',
                    text: response.message,
                    showConfirmButton: true
                });
            }
        },
        error: function(xhr, status, error) {
            // Si hubo un error en la solicitud AJAX, mostrar mensaje de error genérico con SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Error en la solicitud AJAX',
                text: 'Hubo un problema al procesar la solicitud. Por favor, inténtalo de nuevo más tarde.',
                showConfirmButton: true
            });
        }
    });
});

});
