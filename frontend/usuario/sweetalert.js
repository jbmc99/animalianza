

function mostrarSweetAlert(mensaje, tipo) {
    Swal.fire({
        title: mensaje,
        icon: tipo,
        confirmButtonText: 'Aceptar'
    });
}
