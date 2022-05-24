function addRowTabla(id_tabla, data) {
    var t = $(id_tabla).DataTable();
    t.row.add(data).draw(false);
}
function editRowTabla(id_tabla, posicion, data) {
    var t = $(id_tabla).DataTable();
    t.row(posicion).data(data).draw(false);
}
function deleteRowTabla(id_tabla, posicion) {
    var t = $(id_tabla).DataTable();
    t.row(posicion).remove().draw(false);
    ;
}

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function isEmpty(obj) {
    for(var key in obj) {
        if(obj.hasOwnProperty(key))
            return false;
    }
    return true;
}

function mostrarErrores(errores) {
    if (errores) {
        if (errores.length > 0) {
//             toastr.clear();
            for (var i=0; i< errores.length; i++) {
                _toastr("error", errores[i], false);
            }
        }
    }
}

function rellenarSelector(selector, data, idselected) {
    selector.html("");
    if(idselected){
        idselected = parseInt(idselected);
    }
    if (data) {
        $.each(data, function (key, value) {
            var selected = "";
            if (idselected) {
                if (value[0] == idselected) {
                    selected = "selected";
                }
            }
            var subtitle="";
            if(value[2]){
                subtitle = "data-subtext='"+value[2]+"'";
            }
            
            selector.append("<option " + selected + " "+subtitle+" value='" + value[0] + "'>" + value[1] + "</option>");
        });
    }

    $(".selectpicker").selectpicker('refresh');
}

function _toastr(tipo, mensaje, reset) {
    // toastr.clear();
    if(reset==true){
      $.toast().reset('all');
    }

    switch (tipo.toLowerCase()) {
        case 'success':
            $.toast({heading: 'Éxito', text: mensaje, position: 'top-right', icon: 'success', hideAfter: 3500,stack: 6});
            break;
        case 'warning':
            $.toast({heading: 'Información', text: mensaje, position: 'top-right', icon: 'warning', hideAfter: 3500,stack: 6});
            break;
        case 'info':
            $.toast({heading: 'Información', text: mensaje, position: 'top-right', icon: 'info', hideAfter: 3500,stack: 6});
            break;
        case 'error':
            $.toast({heading: 'Error', text: mensaje, position: 'top-right', icon: 'error', hideAfter: 3500,stack: 6});
            break;
        default :
            console.log("no encontrado: " + tipo);
            break;
    }

}

function _loading(show, block_ele, mensaje) {
    if (show) {
        $(block_ele).block({
            message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; ' + mensaje + '</div>',
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'transparent'
            }
        });
    } else {
        $(block_ele).unblock();
    }
}

function getAjax(variables, url) {


    var call = $.ajax({
        type: "POST",
        data: variables,
        async: true,
        url: url,
        success: function () {}
    });

    return call;
}
function getAjaxFormData(form_data, url) {


    var call = $.ajax({
        type: "POST",
        url: url,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        success: function () {}
    });

    return call;
}


function generica(idtabla,data, lenguaje, sinorden, invisible) {


    $(idtabla).dataTable({
        "destroy": true,
        "paging": true,
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
//        "order": [[1, "asc"]],
        "data": data,
//        "initComplete": function (settings, json) {
////            $("#filtrar").prop("disabled", false);
//        },
        "columnDefs": [
            {type: "spanish-string", targets: lenguaje},
            {"orderable": false, "targets": sinorden},
            {"bVisible": false, "aTargets": invisible}
        ],
        "language": {
            "processing": '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span> Cargando Datos...</span>',
            "sSearch": "",
            "sLengthMenu": "Mostrar _MENU_ &nbsp;&nbsp;&nbsp;&nbsp",
            "emptyTable": "No hay resultados disponibles",
            "sInfoFiltered": "Siguiente",
            "sZeroRecords": "No hay resultados",
            "oPaginate": {
                "sNext": ">>",
                "sPrevious": "<<"
            }
        },
        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
        "dom": '<"top"Bfrti> <"bottom"lp>',
        "buttons": [
        ]
    });

    $('.dataTables_filter input').css("margin-right", "5px");
    $('.dataTables_processing').css("height", "50px");
    $('.dataTables_filter input').attr("placeholder", "Buscar");
    $('.dataTables_filter input').attr("class", "form-control");

    $('.dt-buttons a').removeClass('dt-button buttons-excel buttons-html5').addClass('btn botonesgestion');
    $('.dt-buttons').addClass('ajustebotonacivas');


}
