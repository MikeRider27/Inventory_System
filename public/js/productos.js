
$("#listado").on("click", ".btnEditarCategoria", function () {
   
    var Cid = $(this).attr("idcategoria");  
   
    $.ajax({
        url: "Editar-Categoria/" + Cid,
        type: "GET",       
        success: function (respuesta) {
            
            $("#idEditar").val(respuesta.id);
            $("#nombreEditar").val(respuesta.nombre);           
        }
    });
});



$("#listado").on("click", ".btnEliminarCategoria", function () {
   
    var Cid = $(this).attr("idcategoria");  
    var Cnombre = $(this).attr("categoria");
   
    Swal.fire({
        title: '¿Estás seguro de eliminar la categoria '+Cnombre+ '?',
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
                url: "Eliminar-Categoria/" + Cid,
                type: "GET",
                success: function () {
                    Swal.fire(
                        '¡Eliminado!',
                        'La categoria sido eliminada.',
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

$("#selectCategoria").change(function () {
    var idCategoria = $(this).val();

    $.ajax({
        url: "Generar-Codigo-Producto/" + idCategoria,
        type: "GET",
        success: function (respuesta) {
            console.log(respuesta);

            var codigo;
            if (respuesta == 0) {
                codigo = idCategoria + "01"; // Si no hay productos, comienza en 01
            } else {
                var numero = parseInt(respuesta.slice(-2)) + 1; // Obtiene los últimos 2 dígitos del código
                codigo = idCategoria + (numero < 10 ? "0" : "") + numero; // Formatea correctamente
            }
            
            $("#codigoProducto").val(codigo);
        }
    });
});

$('input[type="checkbox"].minimal').iCheck({

    checkboxClass: 'icheckbox_minimal-blue',
});

$("#precioCompra").change(function () {
    
    if ($(".porcentaje").prop("checked")) {
        
        var valorPorcentaje = $("#ValorPorcentaje").val();

        var porcentaje = Number(($("#precioCompra").val() * valorPorcentaje / 100)) + Number($("#precioCompra").val());

        $("#precioVenta").val(porcentaje);
        $("#precioVenta").prop("readonly", true);
    }
});

$("#ValorPorcentaje").change(function () {

    if ($(".porcentaje").prop("checked")) {
        
        var valorPorcentaje = $("#ValorPorcentaje").val();

        var porcentaje = Number(($("#precioCompra").val() * valorPorcentaje / 100)) + Number($("#precioCompra").val());

        $("#precioVenta").val(porcentaje);
        $("#precioVenta").prop("readonly", true);
    }

});

$(".porcentaje").on("ifUnchecked", function () {
    $("#precioVenta").prop("readonly", false);
});

$("#selectCategoriaEditar").change(function () {
    var idCategoria = $(this).val();

    $.ajax({
        url: "Generar-Codigo-Producto/" + idCategoria,
        type: "GET",
        success: function (respuesta) {
            console.log(respuesta);

            var codigo;
            if (respuesta == 0) {
                codigo = idCategoria + "01"; // Si no hay productos, comienza en 01
            } else {
                var numero = parseInt(respuesta.slice(-2)) + 1; // Obtiene los últimos 2 dígitos del código
                codigo = idCategoria + (numero < 10 ? "0" : "") + numero; // Formatea correctamente
            }
            
            $("#codigoProductoEditar").val(codigo);
        }
    });
});



$("#listado").on("click", ".btnEditarProducto", function () {
   
    var Pid = $(this).attr("idproducto");  
   
    $.ajax({
        url: "Editar-Producto/" + Pid,
        type: "GET",       
        success: function (respuesta) {
            
            $("#idEditar").val(respuesta.id);
            $("#codigoProductoEditar").val(respuesta.codigo);
            $("#descripcionEditar").val(respuesta.descripcion);
            $("#selectCategoriaEditar").val(respuesta.id_categoria).trigger("change");
            $("#stockEditar").val(respuesta.stock);
            function limpiarNumero(valor) {
                valor = valor.replace(/\./g, '').replace(',', '.'); // Eliminar puntos y cambiar coma por punto
                valor = parseFloat(valor) / 100; // Dividir por 100 para corregir escala
                return Number.isInteger(valor) ? valor.toString() : valor.toFixed(2).replace(/\.00$/, ''); // Si es entero, quitar decimales
            }
            
            var precioCompra = limpiarNumero(respuesta.precio_compra);
            $("#precioCompraEditar").val(precioCompra);
            
            var precioVenta = limpiarNumero(respuesta.precio_venta);
            $("#precioVentaEditar").val(precioVenta); 
            
            if (respuesta.imagen != '') {
                $("#imagenProductoEditar").attr("src", "storage/" + respuesta.imagen);
            } else {
                $("#imagenProductoEditar").attr("src", "storage/productos/default.png");
            }              
        }
    });
});

$("#precioCompraEditar").change(function () {
    
    if ($(".porcentajeEditar").prop("checked")) {
        
        var valorPorcentaje = $("#ValorPorcentajeEditar").val();

        var porcentaje = Number(($("#precioCompraEditar").val() * valorPorcentaje / 100)) + Number($("#precioCompraEditar").val());

        $("#precioVentaEditar").val(porcentaje);
        $("#precioVentaEditar").prop("readonly", true);
    }
});

$("#ValorPorcentajeEditar").change(function () {

    if ($(".porcentajeEditar").prop("checked")) {
        
        var valorPorcentaje = $("#ValorPorcentajeEditar").val();

        var porcentaje = Number(($("#precioCompraEditar").val() * valorPorcentaje / 100)) + Number($("#precioCompraEditar").val());

        $("#precioVentaEditar").val(porcentaje);
        $("#precioVentaEditar").prop("readonly", true);
    }

});

$(".porcentajeEditar").on("ifUnchecked", function () {
    $("#precioVentaEditar").prop("readonly", false);
});

$("#listado").on("click", ".btnEliminarProducto", function () {
    console.log("hola");
   
    var Pid = $(this).attr("idproducto");  
    var Pnombre = $(this).attr("producto");
   
    Swal.fire({
        title: '¿Estás seguro de eliminar el producto '+Pnombre+'?',
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
                url: "Eliminar-Producto/" + Pid,
                type: "GET",
                success: function () {
                    Swal.fire(
                        '¡Eliminado!',
                        'El Producto a sido eliminado.',
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