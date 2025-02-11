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
            var nuevaClaseBoton = estado == 0 ? "btn-success" : "btn-danger";
            var nuevaClaseIcono = estado == 0 ? "fa-lock-open" : "fa-lock";
            var nuevaClaseEstado = estado == 0 ? "badge-danger" : "badge-success";

            // Actualizar botón
            $this.removeClass("btn-success btn-danger").addClass(nuevaClaseBoton);
            $this.attr("estado", nuevoEstado);
            $this.find("i").removeClass("fa-lock fa-lock-open").addClass(nuevaClaseIcono);

            // Actualizar estado en la columna
            var $estadoBadge = $this.closest("tr").find(".badge");
            $estadoBadge.removeClass("badge-success badge-danger").addClass(nuevaClaseEstado).text(nuevoTexto);
        }
    });
});
