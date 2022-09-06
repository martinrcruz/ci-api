let modal_forma_pago = "#modal-forma-pago";

let form_forma_pago = {
    id: $('#formulario-forma-pago'),
    id_forma_pago: $('#form-forma-pago-id'),
    nombre: $('#form-forma-pago-nombre'),
    descripcion: $('#form-forma-pago-descripcion'),
    rubro: $('#form-forma-pago-rubro'),
    correo: $('#form-forma-pago-correo'),
    celular: $('#form-forma-pago-celular'),
    telefono: $('#form-forma-pago-telefono'),
    nombre_contacto: $('#form-forma-pago-nombre-contacto'),
    rut_forma_pago: $('#form-forma-pago-rut-forma-pago'),
    direccion: $('#form-forma-pago-direccion'),
    ciudad: $('#form-forma-pago-ciudad'),
}



let tabla_forma_pago = {
    id: '#tabla-forma-pago',
    columnas: [
        { data: 'id_forma_pago' },
        { data: 'nombre' },
        { data: 'descripcion' },
        { data: 'empresa' },
        { data: 'fecha_creacion' },
        { data: 'editar' },
        { data: 'eliminar' },

    ],
    fechainicio: null,
    fechafin: null,
    url: base_url + "mantenedor/formaPago/getFormaPago",
    recordsTotal: 0
}


var filtroInicio = $("#filtro-inicio");
var filtroFin = $("#filtro-fin");
var filtroTipoDocumento = $('#filtro-tipo-documento')
var filtroCliente = $('#filtro-cliente')

cargarTabla(tabla_forma_pago);

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

form_forma_pago.id.submit(function (e) {
    var nombre = form_forma_pago.nombre.val();
    var descripcion = form_forma_pago.descripcion.val();
    var empresa = form_forma_pago.empresa.val();



    let formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('descripcion', descripcion);
    formData.append('empresa', empresa);

    e.preventDefault();

    $(modal_forma_pago).loading({ message: 'Enviando información...' });
    getAjaxFormData(formData, base_url + 'mantenedor/formaPago/insertFormaPago').then(function (result) {
        result = JSON.parse(result);
        console.log(result)

        if (result.proceso == 1) {
            $("#modal-forma-pago").modal("hide");
            form_forma_pago.nombre.val('');
            form_forma_pago.descripcion.val('');
            form_forma_pago.empresa.val('');
          
       
            cargarTabla(tabla_forma_pago);

            _toastr("success", "El usuario fue actualizado exitosamente", true);
        }
    });

    $(modal_forma_pago).loading('stop');

})


$(document).on('click', "#borrar_forma_pago", function () {
    let id = $(this).attr("data-forma-pago"),
        name = $(this).attr("data-nombre");

    Swal.fire({
        title: "Confirmar eliminación",
        text: "¿Está seguro de eliminar al forma_pago '" + name + "'?",
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

            getAjaxFormData(formulario, base_url + 'mantenedor/formaPago/deleteFormaPago').then(function (result) {
                result = JSON.parse(result);
                if (result.proceso == 0) {
                    _toastr("error", "Ocurrio un error en el proceso, intente nuevamente", true);
                } else {
                    _toastr("success", "El forma_pago fue eliminado exitosamente", true);
                    cargarTabla(tabla_forma_pago);
                }
            });
            $('body').loading('stop');
        }
    });
});


$(document).on("click", '#editar_forma_pago', function () {

    $('body').loading({ message: 'Cargando...' });
    modalFlag = 2;
    limpiaModal();
    let id = $(this).attr("data-forma-pago");

    $("#modal-forma-pago").modal("show");
    $("#modal-forma-pago").find(".modal-title").text("Editar un forma_pago");
    $("#modal-forma-pago").find(".button-title").text("Guardar cambios");
    let formulario = new FormData();
    formulario.append('id', id);
    getAjaxFormData(formulario, base_url + 'mantenedor/formaPago/getFormaPagoById').then(function (result) {
        result = JSON.parse(result);
        if (result.errores.length == 0) {
            result.data.map(function (res, index) {

                form_forma_pago.nombre.val(res.nombre);
                form_forma_pago.descripcion.val(res.descripcion);
                form_forma_pago.empresa.val(res.empresa);
            


            });

        }
        if (result.proceso == 0) {
            _toastr("error", "Ocurrio un error en el proceso, intente nuevamente", true);
        } else {
            _toastr("success", "El forma_pago fue editado exitosamente", true);
            cargarTabla(tabla_forma_pago);
        }
    })

    $('body').loading('stop');

});



function limpiaModal() {
    form_forma_pago.nombre.val('');
    form_forma_pago.descripcion.val('');
    form_forma_pago.empresa.val('');

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