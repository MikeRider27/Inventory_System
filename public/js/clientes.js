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
        data: {documento: documento},
        success: function (respuesta) {

            if(respuesta == false){
                $("#nuevoDocumento").parent().after('<div class="alert alert-danger">Este Documento ya se encuentra registrado.</div>');
            }         
        }
    });
});