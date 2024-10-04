function confirmAction(action, id_solicitud) {
    let actionText, confirmButtonText, confirmButtonColor;

    if (action === 'autorizada') {
        actionText = 'autorizar la solicitud';
        confirmButtonText = 'Sí, autorizar';
        confirmButtonColor = '#28a745';
    } else if (action === 'rechazada') {
        actionText = 'rechazar la solicitud';
        confirmButtonText = 'Sí, rechazar';
        confirmButtonColor = '#dc3545';
    } else if (action === 'entregada') {
        actionText = 'entregar el medicamento';
        confirmButtonText = 'Sí, entregar';
        confirmButtonColor = '#007bff';
    }

    Swal.fire({
        title: '¿Estás seguro?',
        text: `Estás a punto de ${actionText}.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: confirmButtonColor,
        cancelButtonColor: '#6c757d',
        confirmButtonText: confirmButtonText,
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Enviar el formulario según la acción
            if (action === 'autorizada' || action === 'rechazada') {
                autorizarRechazarSolicitud(id_solicitud, action);
            } else if (action === 'entregada') {
                entregarMedicamento(id_solicitud);
            }
        }
    });
}


// Función para autorizar o rechazar solicitud
function autorizarRechazarSolicitud(idSolicitud, estado) {
    $.post('../medicamentos/autorizar_medicamento.php', { id_solicitud: idSolicitud, estado: estado }, function(response) {
        // Mostrar SweetAlert2 dependiendo de la respuesta
        if (response.success) {
            Swal.fire({
                title: '¡Éxito!',
                text: 'La solicitud ha sido actualizada correctamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                location.reload(); // Recargar la página después de la acción
            });
        } else {
            Swal.fire({
                title: 'Error',
                text: 'Hubo un problema al actualizar la solicitud.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    }, 'json');
}

// Función para entregar medicamento
function entregarMedicamento(id_solicitud) {
    $.post('../medicamentos/entregar_medicamento.php', { id_solicitud: id_solicitud }, function(response) {
        // Mostrar SweetAlert2 dependiendo de la respuesta
        if (response.success) {
            Swal.fire({
                title: '¡Éxito!',
                text: 'El medicamento ha sido entregado correctamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                location.reload(); // Recargar la página después de la entrega
            });
        } else {
            Swal.fire({
                title: 'Error',
                text: 'Hubo un problema al entregar el medicamento.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    }, 'json');
}