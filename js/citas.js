$(document).ready(function() {
    // Función para eliminar cita
    $('.eliminar-cita').on('click', function() {
        var citaId = $(this).data('id');
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../citas/eliminar_cita.php',
                    type: 'POST',
                    data: { cita_id: citaId },
                    success: function(response) {
                        var resultado = JSON.parse(response);
                        if (resultado.success) {
                            Swal.fire(
                                'Eliminada!',
                                'La cita ha sido eliminada.',
                                'success'
                            ).then(() => {
                                location.reload(); // Recargar la página para ver los cambios
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Error al eliminar la cita.',
                                'error'
                            );
                        }
                    }
                });
            }
        });
    });

    // Abrir el modal con los datos de la cita seleccionada
    $('.editar-cita').on('click', function() {
        var citaId = $(this).data('id');

        // Cargar los datos de la cita en el modal
        $.ajax({
            url: '../citas/obtener_cita.php',
            type: 'POST',
            data: { cita_id: citaId },
            success: function(response) {
                var cita = JSON.parse(response);
                $('#cita_id').val(cita.cita_id);
                $('#fecha').val(cita.fecha);
                $('#hora').val(cita.hora);
                $('#estado').val(cita.estado);
                $('#editarCitaModal').modal('show');
            }
        });
    });

    // Enviar la solicitud para actualizar la cita
    $('#editarCitaForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '../citas/editar_cita.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                var resultado = JSON.parse(response);
                if (resultado.success) {
                    // Mostrar un cuadro de diálogo de éxito con SweetAlert2
                    Swal.fire(
                        '¡Actualizado!',
                        'Cambios guardados exitosamente',
                        'success'
                    ).then(() => {
                        $('#editarCitaModal').modal('hide');
                        location.reload(); // Recargar la página para ver los cambios
                    });
                } else {
                    Swal.fire(
                        'Error!',
                        'Error al guardar los cambios',
                        'error'
                    ).then(() => {
                        $('#editarCitaModal').modal('hide');
                        location.reload(); // Recargar la página para ver los cambios
                    });
                }

            }
        });
    });
});