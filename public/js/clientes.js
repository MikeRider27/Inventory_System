$("[data-mask]").inputmask();

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#nuevoDocumento").change(function () {

    $(".alert").remove();

    var documento = $(this).val();

    $.ajax({
        url: "Validar-Documento",
        type: "POST",
        data: {documento: documento, id: 0},
        success: function (respuesta) {

            if(respuesta == false){
                $("#nuevoDocumento").parent().after('<div class="alert alert-danger">Este Documento ya se encuentra registrado.</div>');
            }         
        }
    });
});


$("#listado").on("click", ".btnEditarCliente", function () {

    var Cid = $(this).attr("idcliente");

    $.ajax({
        url: "Editar-Cliente/" + Cid,
        type: "GET",       
        success: function (respuesta) {
            $('#idClienteEditar').val(respuesta.id);
            $('#nombreClienteEditar').val(respuesta.nombre);
            $('#nuevoDocumentoEditar').val(respuesta.documento);
            $('#emailEditar').val(respuesta.email);
            $('#telefonoEditar').val(respuesta.telefono);
            $('#direccionEditar').val(respuesta.direccion);
            $('#fechaNacimientoEditar').val(respuesta.fecha_nacimiento);              
        }
    });
});

$("#nuevoDocumentoEditar").change(function () {

    $(".alert").remove();

    var documento = $(this).val();
    var Cid = $('#idClienteEditar').val();

    $.ajax({
        url: "Validar-Documento",
        type: "POST",
        data: {documento: documento, id: Cid},
        success: function (respuesta) {

            if(respuesta == false){
                $("#nuevoDocumentoEditar").parent().after('<div class="alert alert-danger">Este Documento ya se encuentra registrado.</div>');

                $("#nuevoDocumentoEditar").val('');
            }         
        }
    });
});


$("#listado").on("click", ".btnEliminarCliente", function () {

    var Cid = $(this).attr("idcliente");
    var nombre = $(this).attr("cliente");    

    Swal.fire({
        title: '¿Estás seguro de eliminar el cliente: ' +nombre+' ?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "Eliminar-Cliente/" + Cid,
                type: "GET",
                success: function () {
                    Swal.fire(
                        '¡Eliminado!',
                        'El cliente ha sido eliminado.',
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            });
        }
    });

});