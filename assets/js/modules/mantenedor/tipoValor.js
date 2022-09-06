let modal_tipo_valor = "#modal-tipo-valor";

let form_tipo_valor = {
    id: $('#formulario-tipo-valor'),
    id_tipo_valor: $('#form-tipo-valor-id'),
    nombre: $('#form-tipo-valor-nombre'),
    descripcion: $('#form-tipo-valor-descripcion'),
}



let tabla_tipo_valor = {
    id: '#tabla-tipo-valor',
    columnas: [
        { data: 'id_tipo_valor' },
        { data: 'nombre' },
        { data: 'descripcion' },
        { data: 'fecha_creacion' },
        { data: 'editar' },
        { data: 'eliminar' },

    ],
    fechainicio: null,
    fechafin: null,
    url: base_url + "mantenedor/tipoValor/getTipoValor",
    recordsTotal: 0
}


var filtroInicio = $("#filtro-inicio");
var filtroFin = $("#filtro-fin");
var filtroTipoDocumento = $('#filtro-tipo-documento')
var filtroCliente = $('#filtro-cliente')

cargarTabla(tabla_tipo_valor);

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

form_tipo_valor.id.submit(function (e) {
    var nombre = form_tipo_valor.nombre.val();
    var descripcion = form_tipo_valor.descripcion.val();



    let formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('descripcion', descripcion);
 

    e.preventDefault();

    $(modal_tipo_valor).loading({ message: 'Enviando información...' });
    getAjaxFormData(formData, base_url + 'mantenedor/tipoValor/insertTipoValor').then(function (result) {
        result = JSON.parse(result);
        console.log(result)

        if (result.proceso == 1) {
            $("#modal-tipo-valor").modal("hide");
            form_tipo_valor.nombre.val('');
            form_tipo_valor.descripcion.val('');

       
            cargarTabla(tabla_tipo_valor);

            _toastr("success", "El usuario fue actualizado exitosamente", true);
        }
    });

    $(modal_tipo_valor).loading('stop');

})


$(document).on('click', "#borrar_tipo_valor", function () {
    let id = $(this).attr("data-tipo-valor"),
        name = $(this).attr("data-nombre");

    Swal.fire({
        title: "Confirmar eliminación",
        text: "¿Está seguro de eliminar al tipo_valor '" + name + "'?",
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

            getAjaxFormData(formulario, base_url + 'mantenedor/tipoValor/deleteTipoValor').then(function (result) {
                result = JSON.parse(result);
                if (result.proceso == 0) {
                    _toastr("error", "Ocurrio un error en el proceso, intente nuevamente", true);
                } else {
                    _toastr("success", "El tipo_valor fue eliminado exitosamente", true);
                    cargarTabla(tabla_tipo_valor);
                }
            });
            $('body').loading('stop');
        }
    });
});


$(document).on("click", '#editar_tipo_valor', function () {

    $('body').loading({ message: 'Cargando...' });
    modalFlag = 2;
    limpiaModal();
    let id = $(this).attr("data-tipo-valor");

    $("#modal-tipo-valor").modal("show");
    $("#modal-tipo-valor").find(".modal-title").text("Editar un tipo_valor");
    $("#modal-tipo-valor").find(".button-title").text("Guardar cambios");
    let formulario = new FormData();
    formulario.append('id', id);
    getAjaxFormData(formulario, base_url + 'mantenedor/tipoValor/getTipoValorById').then(function (result) {
        result = JSON.parse(result);
        if (result.errores.length == 0) {
            result.data.map(function (res, index) {

                form_tipo_valor.nombre.val(res.nombre);
                form_tipo_valor.descripcion.val(res.descripcion);
    


            });

        }
        if (result.proceso == 0) {
            _toastr("error", "Ocurrio un error en el proceso, intente nuevamente", true);
        } else {
            _toastr("success", "El tipo_valor fue editado exitosamente", true);
            cargarTabla(tabla_tipo_valor);
        }
    })

    $('body').loading('stop');

});



function limpiaModal() {
    form_tipo_valor.nombre.val('');
    form_tipo_valor.descripcion.val('');

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