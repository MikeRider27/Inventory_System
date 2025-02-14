$(".selectRol").change(function(){
    var rol = $(this).val();

    if(rol != "Administrador"){
        $(".selectSucursal").show();
    }else{
        $(".selectSucursal").hide();
    }

});

//Editar Usuario ===================================
$("#listado").on("click", ".btnEstadoUser", function () {
    var $this = $(this);
    var Uid = $this.attr("Uid");
    var estado = $this.attr("estado");

    $.ajax({
        url: "Cambiar-Estado-Usuario/" + Uid + "/" + estado,
        type: "GET",       
        success: function () {
            var nuevoEstado = estado == 0 ? 1 : 0;
            var nuevoTexto = estado == 0 ? "Inactivo" : "Activo";
            var nuevaClaseBoton = estado == 0 ? "btn-success" : "btn-info";
            var nuevaClaseIcono = estado == 0 ? "fa-lock-open" : "fa-lock";
            var nuevaClaseEstado = estado == 0 ? "badge-danger" : "badge-success";

            // Actualizar botón
            $this.removeClass("btn-success btn-info").addClass(nuevaClaseBoton);
            $this.attr("estado", nuevoEstado);
            $this.find("i").removeClass("fa-lock fa-lock-open").addClass(nuevaClaseIcono);

            // Actualizar estado en la columna
            var $estadoBadge = $this.closest("tr").find(".badge");
            $estadoBadge.removeClass("badge-success badge-danger").addClass(nuevaClaseEstado).text(nuevoTexto);
        }
    });
});

$("#listado").on("click", ".btnEditarUser", function () {
   
    var Uid = $(this).attr("idusuario");  
   
    $.ajax({
        url: "Editar-Usuario/" + Uid,
        type: "GET",       
        success: function (respuesta) {
            
            $("#idEditar").val(respuesta.id);
            $("#nombreEditar").val(respuesta.name);
            $("#emailEditar").val(respuesta.email);
            $("#id_rol").val(respuesta.rol).trigger("change");

            if (respuesta.rol != "Administrador") {
                $(".selectSucursal").show();
                $("#id_sucursal").val(respuesta.id_sucursal).trigger("change");
            } else {
                $(".selectSucursal").hide();
            }
        }
    });
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Validar correo
$("#emailEditar").change(function () {
    var email = $(this).val();
    var idUser = $("#idEditar").val();

    $(".alert").remove();

    $.ajax({
        url: "Verificar-Usuario",
        type: "POST",
        data: {
            email: email,
            id: idUser
        },
        success: function (respuesta) {
         
            if (respuesta['verificacion'] == false) {
                $("#emailEditar").parent().after('<div class="alert alert-danger" role="alert">El correo ya se encuentra registrado</div>');
                $("#emailEditar").val("");
            }
        }
    });
});

$("#listado").on("click", ".btnEliminarUser", function () {

    var Uid = $(this).attr("idusuario");  

    Swal.fire({
        title: '¿Estás seguro?',
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
                url: "Eliminar-Usuario/" + Uid,
                type: "GET",
                success: function () {
                    Swal.fire(
                        '¡Eliminado!',
                        'El usuario ha sido eliminado.',
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
