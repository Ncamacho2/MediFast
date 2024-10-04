$(document).ready(function() {
    $(document).ready(function() {
        // Cargar todos los resultados de exámenes mediante AJAX
        $.ajax({
            url: '../resultados/ver_resultados.php',
            type: 'GET', // No necesitamos enviar diagnóstico ID para cargar todos los resultados
            success: function(response) {
                var resultados = JSON.parse(response);
                var resultadosHtml = '';
                resultados.forEach(function(resultado) {

                    resultadosHtml += '<tr>';
                    resultadosHtml += '<td>' + resultado.id_resultado + '</td>';
                    resultadosHtml += '<td>' + resultado.nombre_paciente + '</td>';
                    resultadosHtml += '<td>' + resultado.diagnostico_descripcion + '</td>';
                    resultadosHtml += '<td>' + resultado.tipo_examen + '</td>';
                    resultadosHtml += '<td>' + resultado.resultado_descripcion + '</td>';
                    resultadosHtml += '<td>' + resultado.fecha_examen + '</td>';
                    resultadosHtml += '<td>' + resultado.observaciones + '</td>';
                    resultadosHtml += '<td><button class="btn btn-danger eliminar-resultado" data-id="' + resultado.id_resultado + '">Eliminar</button></td>';
                    resultadosHtml += '</tr>';

                });


                $('#resultadosBody').html(resultadosHtml);
            }
        });

        // Eliminar resultado
        $(document).on('click', '.eliminar-resultado', function() {
            var resultadoId = $(this).data('id');

            // Confirmar con SweetAlert2
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, hacer la solicitud AJAX para eliminar el resultado
                    $.ajax({
                        url: '../resultados/eliminar_resultado.php',
                        type: 'POST',
                        data: { id_resultado: resultadoId },
                        success: function(response) {
                            var resultado = JSON.parse(response);
                            if (resultado.success) {
                                // Mostrar mensaje de éxito con SweetAlert2
                                Swal.fire(
                                    'Eliminado!',
                                    'El resultado ha sido eliminado.',
                                    'success'
                                ).then(() => {
                                    location.reload(); // Recargar la página para ver los cambios
                                });
                            } else {
                                // Mostrar mensaje de error con SweetAlert2
                                Swal.fire(
                                    'Error!',
                                    'Hubo un error al eliminar el resultado.',
                                    'error'
                                );
                            }
                        }
                    });
                }
            });
        });
    });

});