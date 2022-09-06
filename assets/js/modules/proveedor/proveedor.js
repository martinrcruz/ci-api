let modal_proveedor = "#modal-proveedor";

let form_proveedor = {
    id: $('#formulario-proveedor'),
    id_proveedor: $('#form-proveedor-id'),
    nombre: $('#form-proveedor-nombre'),
    descripcion: $('#form-proveedor-descripcion'),
    rubro: $('#form-proveedor-rubro'),
    correo: $('#form-proveedor-correo'),
    celular: $('#form-proveedor-celular'),
    telefono: $('#form-proveedor-telefono'),
    nombre_contacto: $('#form-proveedor-nombre-contacto'),
    rut_empresa: $('#form-proveedor-rut-empresa'),
    direccion_sucursal: $('#form-proveedor-direccion-sucursal'),
    ciudad_sucursal: $('#form-proveedor-ciudad-sucursal'),
}




let tabla_proveedor = {
    id: '#tabla-proveedor',
    columnas: [
        { data: 'id_proveedor' },
        { data: 'nombre' },
        { data: 'descripcion' },
        { data: 'rubro' },
        { data: 'correo' },
        { data: 'celular' },
        { data: 'telefono' },
        { data: 'nombre_contacto' },
        { data: 'rut_empresa' },
        { data: 'direccion_sucursal' },
        { data: 'ciudad_sucursal' },
        { data: 'editar' },
        { data: 'eliminar' },

    ],
    fechainicio: null,
    fechafin: null,
    url: base_url + "proveedor/getProveedor",
    recordsTotal: 0
}


var filtroInicio = $("#filtro-inicio");
var filtroFin = $("#filtro-fin");
var filtroTipoDocumento = $('#filtro-tipo-documento')
var filtroCliente = $('#filtro-cliente')

cargarTabla(tabla_proveedor);

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

form_proveedor.id.submit(function (e) {
    var nombre = form_proveedor.nombre.val();
    var descripcion = form_proveedor.descripcion.val();
    var rubro = form_proveedor.rubro.val();
    var correo = form_proveedor.correo.val();
    var celular = form_proveedor.celular.val();
    var telefono = form_proveedor.telefono.val();
    var nombre_contacto = form_proveedor.nombre_contacto.val();
    var rut_empresa = form_proveedor.rut_empresa.val();
    var direccion_sucursal = form_proveedor.direccion_sucursal.val();
    var ciudad_sucursal = form_proveedor.ciudad_sucursal.val();

    let formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('descripcion', descripcion);
    formData.append('rubro', rubro);
    formData.append('correo', correo);
    formData.append('celular', celular);
    formData.append('telefono', telefono);
    formData.append('nombre_contacto', nombre_contacto);
    formData.append('rut_empresa', rut_empresa);
    formData.append('direccion_sucursal', direccion_sucursal);
    formData.append('ciudad_sucursal', ciudad_sucursal);
    e.preventDefault();

    $(modal_proveedor).loading({ message: 'Enviando información...' });
    getAjaxFormData(formData, base_url + 'proveedor/insertProveedor').then(function (result) {
        result = JSON.parse(result);
        console.log(result)

        if (result.proceso == 1) {
            $("#modal-proveedor").modal("hide");
            form_proveedor.nombre.val('');
            form_proveedor.descripcion.val('');
            form_proveedor.rubro.val('');
            form_proveedor.correo.val('');
            form_proveedor.celular.val('');
            form_proveedor.telefono.val('');
            form_proveedor.nombre_contacto.val('');
            form_proveedor.rut_empresa.val('');
            form_proveedor.direccion_sucursal.val('');
            form_proveedor.ciudad_sucursal.val('');
            cargarTabla(tabla_proveedor);

            _toastr("success", "El usuario fue actualizado exitosamente", true);
        }
    });

    $(modal_proveedor).loading('stop');

})


$(document).on('click', "#borrar_proveedor", function () {
    let id = $(this).attr("data-proveedor"),
        name = $(this).attr("data-nombre");

    Swal.fire({
        title: "Confirmar eliminación",
        text: "¿Está seguro de eliminar al proveedor '" + name + "'?",
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

            getAjaxFormData(formulario, base_url + 'proveedor/deleteProveedor').then(function (result) {
                result = JSON.parse(result);
                if (result.proceso == 0) {
                    _toastr("error", "Ocurrio un error en el proceso, intente nuevamente", true);
                } else {
                    _toastr("success", "El proveedor fue eliminado exitosamente", true);
                    cargarTabla(tabla_proveedor);
                }
            });
            $('body').loading('stop');
        }
    });
});


$(document).on("click", '#editar_proveedor', function () {

    $('body').loading({ message: 'Cargando...' });
    modalFlag = 2;
    limpiaModal();
    let id = $(this).attr("data-proveedor");

    $("#modal-proveedor").modal("show");
    $("#modal-proveedor").find(".modal-title").text("Editar un proveedor");
    $("#modal-proveedor").find(".button-title").text("Guardar cambios");
    let formulario = new FormData();
    formulario.append('id', id);
    getAjaxFormData(formulario, base_url + 'proveedor/getProveedorById').then(function (result) {
        result = JSON.parse(result);
        if (result.errores.length == 0) {
            result.data.map(function (res, index) {

                form_proveedor.nombre.val(res.nombre);
                form_proveedor.descripcion.val(res.descripcion);
                form_proveedor.rubro.val(res.rubro);
                form_proveedor.correo.val(res.correo);
                form_proveedor.celular.val(res.celular);
                form_proveedor.telefono.val(res.telefono);
                form_proveedor.nombre_contacto.val(res.nombre_contacto);
                form_proveedor.rut_empresa.val(res.rut_empresa);
                form_proveedor.direccion_sucursal.val(res.direccion_sucursal);
                form_proveedor.ciudad_sucursal.val(res.ciudad_sucursal);

            });

        }
        if (result.proceso == 0) {
            _toastr("error", "Ocurrio un error en el proceso, intente nuevamente", true);
        } else {
            _toastr("success", "El proveedor fue editado exitosamente", true);
            cargarTabla(tabla_proveedor);
        }
    })

    $('body').loading('stop');

});






function limpiaModal() {
    form_proveedor.nombre.val('');
    form_proveedor.descripcion.val('');
    form_proveedor.rubro.val('');
    form_proveedor.correo.val('');
    form_proveedor.celular.val('');
    form_proveedor.telefono.val('');
    form_proveedor.nombre_contacto.val('');
    form_proveedor.rut_empresa.val('');
    form_proveedor.direccion_sucursal.val('');
    form_proveedor.ciudad_sucursal.val('');
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