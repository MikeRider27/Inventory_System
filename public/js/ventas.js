//Agregar producto
$(".table").on("click", ".btnAgregarProducto", function () {
    var idproducto = $(this).attr("idproducto");
    var idventa = $("#idventa").val();
    console.log(idventa);
    var url = $("#url").val();

    $(this).removeClass("btn-primary btnAgregarProducto");
    $(this).addClass("btn-secondary");
    $(this).attr("disabled", true);

    $.ajax({
        url: url + "/Agregar-Producto-Venta",
        type: "POST",
        data: {
            idproducto: idproducto,
            idventa: idventa,
        },
        success: function (respuesta) {
            $(".ProductosVenta").append(
                '<div class="col-12 col-sm-6 producto-' +
                    respuesta.id +
                    '" id="prod-item" style="padding-right: 0px;">' +
                    '<div class="form-group">' +
                    '<div class="input-group">' +
                    '<div class="input-group-prepend">' +
                    '<span class="input-group-text"><button class="btn btn-danger btn-xs" type="button"><i class="fas fa-times"></i></button></span>' +
                    "</div>" +
                    '<input type="text" class="form-control" value="' +
                    respuesta.descripcion +
                    '" readonly>' +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    '<div class="col-12 col-sm-3">' +
                    '<div class="form-group">' +
                    '<input type="number" class="form-control" min="1" value="' +
                    respuesta.cantidad +
                    '">' +
                    "</div>" +
                    "</div>" +
                    '<div class="col-12 col-sm-3" style="padding-left: 0px;">' +
                    '<div class="form-group">' +
                    '<div class="input-group">' +
                    '<div class="input-group-prepend">' +
                    '<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>' +
                    "</div>" +
                    '<input type="text" class="form-control" value="' +
                    respuesta.precio_venta +
                    '" readonly>' +
                    "</div>" +
                    "</div>" +
                    "</div>"
            );
        },
    });
});

function CargarProductosVentas() {
    var idventa = $("#idventa").val();
    var url = $("#url").val();
    var estado = $("#estado").val();

    $.ajax({
        url: url + "/Cargar-Productos-Venta/" + idventa,
        type: "GET",
        data: {
            idventa: idventa,
        },
        success: function (respuesta) {
            var productos = respuesta.productos;
            productos.forEach((producto) => {
                
                
                if (producto.estado == "Finalizada") {
                    var readonly = "readonly";
                    var botonCancelar = "";
                } else {
                    var readonly = "";
                    var botonCancelar =
                        '<span class="input-group-text"><button class="btn btn-danger btn-xs" type="button"><i class="fas fa-times"></i></button></span>';
                }

                $(".ProductosVenta").append(
                    '<div class="col-12 col-sm-6 producto-' +
                        producto.id +
                        '" id="prod-item" style="padding-right: 0px;">' +
                        '<div class="form-group">' +
                        '<div class="input-group">' +
                        '<div class="input-group-prepend">' +
                        botonCancelar+
                        "</div>" +
                        '<input type="text" class="form-control" value="' +
                        producto.descripcion +
                        '" readonly>' +
                        "</div>" +
                        "</div>" +
                        "</div>" +
                        '<div class="col-12 col-sm-3">' +
                        '<div class="form-group">' +
                        '<input type="number" class="form-control" min="1" value="' +
                        producto.cantidad +
                        '" '+readonly+'>' +
                        "</div>" +
                        "</div>" +
                        '<div class="col-12 col-sm-3" style="padding-left: 0px;">' +
                        '<div class="form-group">' +
                        '<div class="input-group">' +
                        '<div class="input-group-prepend">' +
                        '<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>' +
                        "</div>" +
                        '<input type="text" class="form-control" value="' +
                        producto.precio +
                        '" readonly>' +
                        "</div>" +
                        "</div>" +
                        "</div>"
                );
            });
        },
    });
}

CargarProductosVentas();
