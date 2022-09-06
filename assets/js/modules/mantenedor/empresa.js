let modal_empresa = "#modal-empresa";

let form_empresa = {
    id: $('#formulario-empresa'),
    id_empresa: $('#form-empresa-id'),
    nombre: $('#form-empresa-nombre'),
    descripcion: $('#form-empresa-descripcion'),
    rubro: $('#form-empresa-rubro'),
    correo: $('#form-empresa-correo'),
    celular: $('#form-empresa-celular'),
    telefono: $('#form-empresa-telefono'),
    nombre_contacto: $('#form-empresa-nombre-contacto'),
    rut_empresa: $('#form-empresa-rut-empresa'),
    direccion: $('#form-empresa-direccion'),
    ciudad: $('#form-empresa-ciudad'),
}



let tabla_empresa = {
    id: '#tabla-empresa',
    columnas: [
        { data: 'id_empresa' },
        { data: 'nombre' },
        { data: 'rut' },
        { data: 'giro' },
        { data: 'direccion' },
        { data: 'ciudad' },
        { data: 'correo' },
        { data: 'celular' },
        { data: 'telefono' },
        { data: 'fecha_creacion' },
        { data: 'editar' },
        { data: 'eliminar' },

    ],
    fechainicio: null,
    fechafin: null,
    url: base_url + "mantenedor/empresa/getEmpresa",
    recordsTotal: 0
}


var filtroInicio = $("#filtro-inicio");
var filtroFin = $("#filtro-fin");
var filtroTipoDocumento = $('#filtro-tipo-documento')
var filtroCliente = $('#filtro-cliente')

cargarTabla(tabla_empresa);

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

form_empresa.id.submit(function (e) {
    var nombre = form_empresa.nombre.val();
    var rut = form_empresa.rut.val();
    var giro = form_empresa.giro.val();
    var correo = form_empresa.correo.val();
    var celular = form_empresa.celular.val();
    var telefono = form_empresa.telefono.val();
    var direccion = form_empresa.direccion.val();
    var ciudad = form_empresa.ciudad.val();


    let formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('rut', rut);
    formData.append('giro', rubro);
    formData.append('correo', correo);
    formData.append('celular', celular);
    formData.append('telefono', telefono);
    formData.append('direccion', direccion);
    formData.append('ciudad', ciudad);

    e.preventDefault();

    $(modal_empresa).loading({ message: 'Enviando información...' });
    getAjaxFormData(formData, base_url + 'mantenedor/empresa/insertEmpresa').then(function (result) {
        result = JSON.parse(result);
        console.log(result)

        if (result.proceso == 1) {
            $("#modal-empresa").modal("hide");
            form_empresa.nombre.val('');
            form_empresa.rut.val('');
            form_empresa.giro.val('');
            form_empresa.correo.val('');
            form_empresa.celular.val('');
            form_empresa.telefono.val('');
            form_empresa.direccion.val('');
            form_empresa.ciudad.val('');
       
            cargarTabla(tabla_empresa);

            _toastr("success", "El usuario fue actualizado exitosamente", true);
        }
    });

    $(modal_empresa).loading('stop');

})


$(document).on('click', "#borrar_empresa", function () {
    let id = $(this).attr("data-empresa"),
        name = $(this).attr("data-nombre");

    Swal.fire({
        title: "Confirmar eliminación",
        text: "¿Está seguro de eliminar al empresa '" + name + "'?",
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

            getAjaxFormData(formulario, base_url + 'mantenedor/empresa/deleteEmpresa').then(function (result) {
                result = JSON.parse(result);
                if (result.proceso == 0) {
                    _toastr("error", "Ocurrio un error en el proceso, intente nuevamente", true);
                } else {
                    _toastr("success", "El empresa fue eliminado exitosamente", true);
                    cargarTabla(tabla_empresa);
                }
            });
            $('body').loading('stop');
        }
    });
});


$(document).on("click", '#editar_empresa', function () {

    $('body').loading({ message: 'Cargando...' });
    modalFlag = 2;
    limpiaModal();
    let id = $(this).attr("data-empresa");

    $("#modal-empresa").modal("show");
    $("#modal-empresa").find(".modal-title").text("Editar un empresa");
    $("#modal-empresa").find(".button-title").text("Guardar cambios");
    let formulario = new FormData();
    formulario.append('id', id);
    getAjaxFormData(formulario, base_url + 'mantenedor/empresa/getEmpresaById').then(function (result) {
        result = JSON.parse(result);
        if (result.errores.length == 0) {
            result.data.map(function (res, index) {

                form_empresa.nombre.val(res.nombre);
                form_empresa.rut.val(res.rut);
                form_empresa.giro.val(res.giro);
                form_empresa.correo.val(res.correo);
                form_empresa.celular.val(res.celular);
                form_empresa.telefono.val(res.telefono);
                form_empresa.direccion.val(res.direccion);
                form_empresa.ciudad.val(res.ciudad);


            });

        }
        if (result.proceso == 0) {
            _toastr("error", "Ocurrio un error en el proceso, intente nuevamente", true);
        } else {
            _toastr("success", "El empresa fue editado exitosamente", true);
            cargarTabla(tabla_empresa);
        }
    })

    $('body').loading('stop');

});



function limpiaModal() {
    form_empresa.nombre.val('');
    form_empresa.rut.val('');
    form_empresa.giro.val('');
    form_empresa.correo.val('');
    form_empresa.celular.val('');
    form_empresa.telefono.val('');
    form_empresa.direccion.val('');
    form_empresa.ciudad.val('');
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