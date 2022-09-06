let mensaje_preview_default = base_url + 'assets/images/default.png';
let imgFotoActual = "";
let modal_actividad = "#modal-cliente";
let modalFlag = 0;

let form_cliente = {
    id: $('#formulario-cliente'),
    idcliente: $('#form-cliente-id'),
    rut: $('#form-cliente-rut'),
    correo: $('#form-cliente-correo'),
    id_empresa: $('#form-cliente-id-empresa'),
    nombre: $('#form-cliente-nombre'),
    apellidop: $('#form-cliente-apellidop'),
    apellidom: $('#form-cliente-apellidom'),
    celular: $('#form-cliente-celular'),
    telefono: $('#form-cliente-telefono'),
    observacion: $('#form-cliente-observacion'),
}


let tabla_cliente = {
    id: '#tabla-cliente',
    columnas: [
        { data: 'id_cliente' },
        { data: 'rut' },
        { data: 'correo' },
        { data: 'id_empresa' },
        { data: 'nombre' },
        { data: 'apellidop' },
        { data: 'apellidom' },
        { data: 'celular' },
        { data: 'telefono' },
        { data: 'observacion' },
        { data: 'fecha_creacion' },
        { data: 'editar' },
        { data: 'eliminar' },

    ],
    url: base_url + "cliente/getCliente",
    recordsTotal: 0
}


var filtroInicio = $("#filtro-inicio");
var filtroFin = $("#filtro-fin");
var filtroTipoDocumento = $('#filtro-tipo-documento')
var filtroCliente = $('#filtro-cliente')


$(document).ready(function() {
    cargarTabla(tabla_cliente);
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