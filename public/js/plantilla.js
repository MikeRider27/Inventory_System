var table = $("#listado").DataTable({
    responsive: true,

    autoWidth: false,
    language: {
        decimal: "",
        emptyTable: "No hay registros en la tabla",
        info: "Se muestran _START_ a _END_ de _TOTAL_ registros",
        infoEmpty: "Se muestran 0 a 0 de 0 registros",
        infoFiltered: "(filtrado de _MAX_ registros totales)",
        infoPostFix: "",
        thousands: ",",
        lengthMenu: "Mostrar _MENU_ registros",
        loadingRecords: "Cargando...",
        processing: "Procesando...",
        search: "Filtrar por (Nombre):",
        zeroRecords: "No se encontraron registros que coincidan",
        paginate: {
            first: "Primero",
            last: "Último",
            next: "Siguiente",
            previous: "Anterior",
        },
        aria: {
            sortAscending: ": activar para ordenar la columna ascendente",
            sortDescending: ": activar para ordenar la columna descendente",
        },
    },
});

//Editar Sucursal ===================================
$("#listado").on("click", ".btnEditarSucursal", function () {
    var idSucursal = $(this).attr("idSucursal");
   

    $.ajax({
        url: "Editar-Sucursal/" + idSucursal,
        type: "GET",
        success: function (Sucursal) { 
            $("#idEditar").val(Sucursal.id);
            $("#nombreEditar").val(Sucursal.nombre);

        },
    });
});

//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
  });
