let mensaje_preview_default = base_url + 'assets/images/default.png';
let imgFotoActual = "";
let modal_actividad = "#modal-actividad";
let modalFlag = 0;

let form_actividad = {
    id: $('#formulario-actividad'),
    idactividad: $('#form-actividad-id'),
    nombre: $('#form-actividad-nombre'),
    area: $('#form-actividad-area-id'),

}

let tabla_area = {
    id: $('#tabla-area-actividad'),
    idarea: $('#tabla-area-id-area'),
    nombre: $('#tabla-area-nombre'),
}



var tabla_actividad = {
    id: '#tabla_actividad',
    columnas: [
        { data: 'actividad' },
        { data: 'opciones' },
    ],
    lenguaje: [1],
    sinorden: [1],
    invisible: [],
    data: { tipo: 1 },
    url: base_url + "actividad/getDataActividad",
    recordsTotal: 0

}

$(document).ready(function() {
    cargarSelectArea(1);
    configurarDescargaExcel();
    cargarTabla(tabla_actividad);
    limpiaModal();
})

$("#btn-actividad-agregar-actividad").on('click', function() {

    $('body').loading({ message: 'Cargando...' });

    modalFlag = 1;
    limpiaModal();
    mostrarModal(1);
    $('body').loading('stop');

});

$("#formulario-actividad").on("submit", function(e) {
    e.preventDefault();

    //console.log('editarrrrrr')
    let nombre = form_actividad.nombre.val();
    let idactividad = form_actividad.idactividad.val();
    let area = form_actividad.area.val();
    let mensaje = "";

    //validaciones

    if (nombre.trim().length == 0) {
        mensaje += 'Falta llenar actividad  ';
    }
    if (nombre == null) {
        mensaje += "Falta elegir actividad  ";
    }

    if (area.trim().length == 0) {
        mensaje += 'Falta llenar area  ';
    }
    if (area == null) {
        mensaje += "Falta elegir area  ";
    }

    if (mensaje.length != 0) {
        Swal.fire({
            title: "Error de validación",
            text: mensaje,
            type: "error",
            confirmButtonColor: '#660CD5',
        })
        return;
    }

    //mandar datos al backend
    let formData = new FormData();
    formData.append('nombre', nombre);
    //formData.append('foto',  foto);
    //modalFlag estados:  2 = Modal adición , 1 = Modal Agregar
    console.log(area);
    if (modalFlag == 2) {
        formData.append('idactividad', idactividad);
    }
    formData.append('area', area);


    formData.append(token_name, token_hash);
    $(modal_actividad).loading({ message: 'Enviando información...' });

    //console.log(result);
    getAjaxFormData(formData, base_url + 'actividad/guardarActividad').then(function(result) {
        result = JSON.parse(result);
        if (result.proceso == 1) {
            $("#modal-actividad").modal("hide");
            form_actividad.nombre.val('');
            form_actividad.idactividad.val('');
            form_actividad.area.val('');
            form_actividad.area.html('').selectpicker('refresh');

            cargarTabla(tabla_actividad);

            if (modalFlag == 1) {
                _toastr("success", "La actividad se agregó exitosamente", true);
            }
        } else if (modalFlag == 2) {
            if (result.errores.length == 0) {
                Swal.fire("Error", "Ocurrio un error en el proceso, intente nuevamente", 'error');
            } else {
                let mensaje = "";
                result.errores.map(function(error) {
                    mensaje += error + "\n";
                });
                Swal.fire("Error de validación", mensaje, 'error');
            }
        } else if (modalFlag == 1) {
            //hubo algun error
            if (result.errores.length != 0) {
                for (let c = 0; c < result.errores.length; c++) {
                    mensaje += result.errores[c] + '\n';
                }
                Swal.fire('Error de validación', mensaje, 'error');
                return;
            }
        }
    });
    $(modal_actividad).loading('stop');
});





function cargarSelectArea(opcion, id) {

    form_actividad.area.html('').selectpicker('refresh');
    var formulario = new FormData();
    formulario.append(token_name, token_hash);
    getAjaxFormData(formulario, base_url + 'actividad/getArea').then(function(result) {
        result = JSON.parse(result);

        if (opcion == 1) {

            for (let c = 0; c < result.data.length; c++) {
                form_actividad.area.append('<option value=' + result.data[c].ID_AREA + '>' + result.data[c].NOMBRE_AREA + '</option>');
            }
            form_actividad.area.selectpicker('refresh');

            $("#modal-proyecto").modal("show");

            $("#label-actividad").text("Elige el área asociada a la actividad. Podras agregar mas áreas asociadas al editar la actividad.");

            $("#modal-proyecto").find(".modal-title").text("Nueva Actividad");
            $("#modal-proyecto").find(".button-title").text("Agregar");


        } else {

            for (let c = 0; c < result.data.length; c++) {
                //console.log(result[c]);
                form_actividad.area.append('<option value=' + result.data[c].ID_AREA + '>' + result.data[c].NOMBRE_AREA + '</option>');
            }
            form_actividad.area.selectpicker('refresh');

            $("#modal-proyecto").modal("show");
            $("#label-actividad").text("Áreas asociadas a la Actividad:");

            $("#modal-proyecto").find(".modal-title").text("Editar Actividad");
            $("#modal-proyecto").find(".button-title").text("Editar");


            let formulario = new FormData();
            formulario.append(token_name, token_hash);
            formulario.append('id', id);
            getAjaxFormData(formulario, base_url + 'actividad/getArea').then(function(result) {
                result = JSON.parse(result);
                if (result.errores.length == 0) {
                    result.data.map(function(ele, index) {
                        form_actividad.area.selectpicker('refresh');

                    });
                }



            });
        }
    });
}

function cargarTablaArea(id) {

    limpiaModal2();

    var table_head = $("#tabla-area-actividad thead")
    head = "<tr><th>ID</th><th class='text-center'>NOMBRE ÁREA</th><th></th></tr>"
    table_head.append(head)

    let formulario = new FormData();
    formulario.append(token_name, token_hash);
    formulario.append('id', id);
    getAjaxFormData(formulario, base_url + 'actividad/getArea').then(function(result) {
        result = JSON.parse(result);
        if (result.errores.length == 0) {
            var table_body = $("#tabla-area-actividad tbody")
                //console.log(result.data)
            for (let c = 0; c < result.data.length; c++) {

                markup = "<tr><td>" + result.data[c].ID_AREA + "</td><td>" + result.data[c].NOMBRE_AREA + "</td><td><i class='fas fa-trash-alt' style='cursor: pointer; color:red;' onclick='borrar_area_actividad(" + result.data[c].ID_ACTIVIDAD_AREA + ", " + id + ")'></i></td></tr>"
                table_body.append(markup)
            }
        }
    });


}


function borrar_area_actividad(id_actividad_area, id) {
    Swal.fire({
        title: "Confirmar eliminación",
        text: "¿Está seguro de eliminar el area relacionada a la Actividad?",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: '<b>Cancelar</b>',
        confirmButtonText: '<b>Eliminar</b>',
        confirmButtonColor: '#dd3445'
    }).then(function(result) {
        //console.log(result)
        if (result.value) {
            let formulario = new FormData();
            formulario.append(token_name, token_hash);
            formulario.append('id_actividad_area', id_actividad_area);
            $('body').loading({ message: 'Cargando datos...' });
            getAjaxFormData(formulario, base_url + 'actividad/eliminar_area_actividad').then(function(result) {
                result = JSON.parse(result);
                if (result.proceso == 0) {
                    _toastr("error", "Ocurrio un error en el proceso, intente nuevamente", true);
                } else {
                    _toastr("success", "La actividad fue eliminada exitosamente", true);
                    cargarTabla(tabla_actividad);
                    cargarTablaArea(id)


                }
                //console.log(result);
            });
            $('body').loading('stop');

        }
    });
}


$(document).on('click', ".borrar_actividad", function() {
    let id = $(this).attr("data-actividad");
    let name = $(this).attr("data-nombre");
    Swal.fire({
        title: "Confirmar eliminación",
        text: "¿Está seguro de eliminar la Actividad  '" + name + "'?",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: '<b>Cancelar</b>',
        confirmButtonText: '<b>Eliminar</b>',
        confirmButtonColor: '#dd3445'
    }).then(function(result) {
        //console.log(result)
        if (result.value) {
            let formulario = new FormData();
            formulario.append(token_name, token_hash);
            formulario.append('id', id);
            $('body').loading({ message: 'Cargando datos...' });
            getAjaxFormData(formulario, base_url + 'actividad/eliminarActividad').then(function(result) {
                result = JSON.parse(result);
                if (result.proceso == 0) {
                    _toastr("error", "Ocurrio un error en el proceso, intente nuevamente", true);
                } else {
                    _toastr("success", "La actividad fue eliminada exitosamente", true);
                    cargarTabla(tabla_actividad);

                }
                //console.log(result);
            });
            $('body').loading('stop');

        }
    });
});



$(document).on("click", '.editar_actividad', function() {

    $('body').loading({ message: 'Cargando...' });

    modalFlag = 2;
    limpiaModal();
    let id = $(this).attr("data-actividad");

    $("#form-notificacion-boton-imagen-us-cargar").show();
    mostrarModal(2, id);
    cargarSelectArea(2, id);
    cargarTablaArea(id);
    $('body').loading('stop');

});




function limpiaModal() {
    $("#label-actividad").text("Elige el área asociada a la actividad. Podras agregar mas áreas asociadas al editar la actividad.");
    form_actividad.nombre.val('');
    form_actividad.idactividad.val('');
    form_actividad.area.val('');
    form_actividad.area.selectpicker('refresh');
    $('#tabla-area-actividad').find('tr').remove();

}

function limpiaModal2() {
    form_actividad.area.val('');
    form_actividad.area.selectpicker('refresh');
    $('#tabla-area-actividad').find('tr').remove();

}



function configurarDescargaExcel() {
    $.fn.dataTable.Api.register('buttons.exportData()', function(options) {

        if (this.context.length) {
            //                console.log(this.context);
            var varibles_post_excel = this.ajax.params();
            var url_excel = this.ajax.url();
            // _loading(true,"body","Exportando a excel... Espere por favor.");
            $.extend(varibles_post_excel, { exportar: true });
            var jsonResult = $.ajax({
                url: url_excel,
                data: varibles_post_excel,
                type: "POST",
                success: function(result) {
                    //Do nothing
                },
                async: false
            });
            // _loading(false,"body");
            jsonResult = $.parseJSON(jsonResult.responseText);
            //                console.log(jsonResult.columns);
            //console.log(jsonResult)
            return { body: jsonResult.data, header: jsonResult.columns };
        }
    });
}


function mostrarModal(opcion, id = '') {
    if (opcion == 1) {
        $("#modal-actividad").modal("show");
        $("#modal-actividad").find(".modal-title").text("Nueva Actividad");
        $("#modal-actividad").find(".button-title").text("Agregar");
    } else {
        $("#modal-actividad").modal("show");
        $("#modal-actividad").find(".modal-title").text("Editar Actividad");
        $("#modal-actividad").find(".button-title").text("Editar");
        let formulario = new FormData();
        formulario.append(token_name, token_hash);
        formulario.append('id', id);
        getAjaxFormData(formulario, base_url + 'actividad/getActividad').then(function(result) {
            result = JSON.parse(result);
            if (result.errores.length == 0) {
                result.data.map(function(ele, index) {
                    form_actividad.idactividad.val(ele.ID);
                    form_actividad.nombre.val(ele.ACTIVIDAD_NOMBRE);
                });
            }

        });

    }


}







function cargarTabla(info) {
    var url = info.url;
    var data = info.data;
    data[token_name] = token_hash;
    /*modificar tabla en todas las demas*/

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
            "processing": '<div style="color:#00bfa6;font-size:14px;font-weight: bold;padding-top:40px;"><i  class="fa fa-spinner fa-spin fa-lg fa-fw"></i>Cargando Datos...</div>',
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