let mensaje_preview_default = base_url + 'assets/images/default.png';
let imgFotoActual = "";
let modal_actividad = "#modal-cotizacion";
let modalFlag = 0;

let form_cotizacion = {
    id: $('#formulario-usuario'),
    idusuario: $('#form-usuario-id'),
    foto: $('#form-usuario-foto'),
    rut: $('#form-usuario-rut'),
    buk: $('#form-usuario-buk'),
    nombre: $('#form-usuario-nombre'),
    apaterno: $('#form-usuario-apaterno'),
    amaterno: $('#form-usuario-amaterno'),
    email: $('#form-usuario-email'),
    empresa: $('#form-usuario-empresa'),
    tipo: $('#form-usuario-tipo'),
    area: $('#form-usuario-area'),
    cargo: $('#form-usuario-cargo'),
    jefatura: $('#form-usuario-jefatura'),
    hora_entrada: $('#form-usuario-entrada'),
    hora_salida: $('#form-usuario-salida'),
    clave: $('#form-usuario-clave')
}


let tabla_cotizacion = {
    id: '#tabla-cotizacion',
    columnas: [
        { data: 'id_cotizacion' },
        { data: 'id_cliente' },
        { data: 'id_usuario' },
        { data: 'observacion' },
        { data: 'tiempo_entrega' },
        { data: 'id_pago_cotizacion' },
        { data: 'id_tipo_impuesto' },
        { data: 'descuento' },
        { data: 'enviado_correo' },
        { data: 'total_neto' },
        { data: 'total_iva' },
        { data: 'total' },
        { data: 'fecha_cotizacion' },
        { data: 'fecha_creacion' },
        { data: 'estado' },
        { data: 'opciones' },
    ],
    url: base_url + "cotizacion/getCotizacion",
    recordsTotal: 0
}


var filtroInicio = $("#filtro-inicio");
var filtroFin = $("#filtro-fin");
var filtroTipoDocumento = $('#filtro-tipo-documento')
var filtroCliente = $('#filtro-cliente')


$(document).ready(function() {
    cargarTabla(tabla_cotizacion);
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
            url: info.url,
            type: "GET",
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