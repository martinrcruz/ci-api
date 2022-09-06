let modal_producto = "#modal-producto";

let form_producto = {
    id: $('#formulario-producto'),
    id_producto: $('#form-producto-id'),
    id_tipo_producto: $('#form-producto-tipo-producto'),
    nombre: $('#form-producto-nombre'),
    descripcion: $('#form-producto-descripcion'),
  
}



let tabla_producto = {
    id: '#tabla-producto',
    columnas: [
        { data: 'id_producto' },
        { data: 'id_tipo_producto' },
        { data: 'nombre' },
        { data: 'descripcion' },
        { data: 'fecha_creacion' },
        { data: 'editar' },
        { data: 'eliminar' },

    ],
    fechainicio: null,
    fechafin: null,
    url: base_url + "mantenedor/producto/getProducto",
    recordsTotal: 0
}


var filtroInicio = $("#filtro-inicio");
var filtroFin = $("#filtro-fin");
var filtroTipoDocumento = $('#filtro-tipo-documento')
var filtroCliente = $('#filtro-cliente')

cargarTabla(tabla_producto);

$(document).ready(function () {

})


function initDate(input) {
    input.datetimepicker({
        locale: 'es',
        showClose: true,
        showClear: true,
        format: "DD-MM-YYYY"
    });
    input.data("DateTimePicker").clear();
}

initDate(filtroInicio);
initDate(filtroFin);

form_producto.id.submit(function (e) {
    var nombre = form_producto.nombre.val();
    var descripcion = form_producto.descripcion.val();
    var id_tipo_producto = form_producto.id_tipo_producto.val();
  


    let formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('descripcion', descripcion);
    formData.append('id_tipo_producto', id_tipo_producto);


    e.preventDefault();

    $(modal_producto).loading({ message: 'Enviando información...' });
    getAjaxFormData(formData, base_url + 'mantenedor/producto/insertProducto').then(function (result) {
        result = JSON.parse(result);
        console.log(result)

        if (result.proceso == 1) {
            $("#modal-producto").modal("hide");
            form_producto.nombre.val('');
            form_producto.descripcion.val('');
            form_producto.id_tipo_producto.val('');
         
       
            cargarTabla(tabla_producto);

            _toastr("success", "El usuario fue actualizado exitosamente", true);
        }
    });

    $(modal_producto).loading('stop');

})


$(document).on('click', "#borrar_producto", function () {
    let id = $(this).attr("data-producto"),
        name = $(this).attr("data-nombre");

    Swal.fire({
        title: "Confirmar eliminación",
        text: "¿Está seguro de eliminar al producto '" + name + "'?",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: '<b>Cancelar</b>',
        confirmButtonText: '<b>Eliminar</b>',
        confirmButtonColor: '#dd3445'
    }).then(function (result) {
        if (result.value) {
            let formulario = new FormData();
            formulario.append('id', id);
            $('body').loading({ message: ' Cargando datos...' });

            getAjaxFormData(formulario, base_url + 'mantenedor/producto/deleteProducto').then(function (result) {
                result = JSON.parse(result);
                if (result.proceso == 0) {
                    _toastr("error", "Ocurrio un error en el proceso, intente nuevamente", true);
                } else {
                    _toastr("success", "El producto fue eliminado exitosamente", true);
                    cargarTabla(tabla_producto);
                }
            });
            $('body').loading('stop');
        }
    });
});


$(document).on("click", '#editar_producto', function () {

    $('body').loading({ message: 'Cargando...' });
    modalFlag = 2;
    limpiaModal();
    let id = $(this).attr("data-producto");

    $("#modal-producto").modal("show");
    $("#modal-producto").find(".modal-title").text("Editar un producto");
    $("#modal-producto").find(".button-title").text("Guardar cambios");
    let formulario = new FormData();
    formulario.append('id', id);
    getAjaxFormData(formulario, base_url + 'mantenedor/producto/getProductoById').then(function (result) {
        result = JSON.parse(result);
        if (result.errores.length == 0) {
            result.data.map(function (res, index) {

                form_producto.nombre.val(res.nombre);
                form_producto.descripcion.val(res.descripcion);
                form_producto.id_tipo_producto.val(res.id_tipo_producto);
             


            });

        }
        if (result.proceso == 0) {
            _toastr("error", "Ocurrio un error en el proceso, intente nuevamente", true);
        } else {
            _toastr("success", "El producto fue editado exitosamente", true);
            cargarTabla(tabla_producto);
        }
    })

    $('body').loading('stop');

});



function limpiaModal() {
    form_producto.nombre.val('');
    form_producto.descripcion.val('');
    form_producto.id_tipo_producto.val('');

}

function cargarTabla(info) {
    var url = info.url;
    var data = info.data;
    var table = $(info.id).DataTable({
        "columns": info.columnas,
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "paging": true,
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": false,
        "ajax": {
            url: url,
            type: "POST",
            data: data

        },


        "columnDefs": [
            { type: "spanish-string", targets: info.lenguaje },
            { "orderable": false, "targets": info.sinorden },
            { "bVisible": false, "aTargets": info.invisible }
        ],
        order: [],
        "language": {
            "sSearch": "",
            "sLengthMenu": "Mostrar _MENU_ &nbsp;&nbsp;&nbsp;&nbsp",
            "emptyTable": "No hay resultados disponibles",
            "info": "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "",
            "infoFiltered": "(filtrado de _MAX_ resultados totales)",
            /*tambien cambiar*/
            "sZeroRecords": "No hay resultados",
            "oPaginate": {
                "sNext": ">>",
                "sPrevious": "<<"
            }
        },
        "lengthMenu": [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        "dom": '<"top"Bfrt> <"bottom" <"row" <"col-4" l><"col-4 text-center" i>  <"col-4" p>>>',
        "buttons": [{
            "extend": 'excel',
            "text": '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar a Excel',

        }]
    });
    $('.dataTables_filter input').css("margin-right", "5px");
    $('.dataTables_processing').css("height", "50px");
    $('.dataTables_processing').css("z-index", "1");
    $('.buttons-excel').addClass('btn-primary btn');
    $('.dataTables_filter input').attr("placeholder", "Buscar");
    $('.dataTables_filter input').attr("class", "form-control");

}