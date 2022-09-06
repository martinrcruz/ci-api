<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="breadcrumb-g">
                <h2 style="display:inline;"><i class="fa-solid fa-house" style="color:#7B6F93; padding-right:1%" aria-hidden="true"></i>Proveedores  / </h2> Panel de proveedores
            </div>
        </div>
    </div>
</div>


<div class="row container-g">
    <div class="col">
        <h1 class="title-g">Proveedor</h1>

    </div>
    <div class="col">
        <button type="button" class="btn btn-agregar-g" data-bs-toggle="modal" data-bs-target="#modal-proveedor" style="float:right;padding: 6;" id="btn-agregar-proveedor">
            <i class="fa fa-plus"></i> Agregar <span class="sub-info">Proveedor</span>
        </button>
    </div>
    <hr>





    <div class="col-12">
        <div id="contenedor-filtros" class="clearfix">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <div class="bootstrap-timepicker">
                                <div class="form-group form-custom-icon-left ">
                                    <span class="form-custom-icon"><i class="fas fa-calendar-alt" id="icon-fecha-inicio" style="color: #7B6F93"></i></span>
                                    <label for="filtro-inicio">Ingresa un año por filtrar: </label>
                                    <input type="text" class="form-control timepicker form-custom-input readonly" id="filtro-inicio" onkeydown="return false" placeholder="Ingrese fecha de inicio">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <div class="bootstrap-timepicker">
                                <div class="form-group form-custom-icon-left">
                                    <span class="form-custom-icon"><i class="fas fa-calendar-alt" id="icon-fecha-fin" style="color: #7B6F93"></i></span>
                                    <label for="filtro-fin">Ingrese un mes a filtrar: </label>
                                    <input type="text" class="form-control form-custom-input readonly timepicker top-10" id="filtro-fin" onkeydown="return false" placeholder="Ingrese fecha de fin">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group form-custom-icon-left">
                                <span class="form-custom-icon"><i class="fas fa-file" id="icon-tipo-documento" style="color: #7B6F93"></i></span>
                                <label for="filtro-tipo-documento">Filtrar por Tipo Documento: </label>
                                <select class="form-control selectpicker select2" id="filtro-tipo-documento" data-live-search="true" name="filtro-tipo-documento" data-dropup-auto="false" placeholder="Selecciona un tipo de documento.">
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group form-custom-icon-left">
                                <span class="form-custom-icon"><i class="fas fa-user" id="icon-cliente" style="color: #7B6F93"></i></span>
                                <label for="filtro-cliente">Filtrar por Cliente: </label>
                                <select class="form-control selectpicker select2" id="filtro-cliente" data-live-search="true" name="filtro-cliente" data-dropup-auto="false" placeholder="Selecciona un cliente">
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="text-center">
                                <button id="boton-filtro" type="submit" class="btn-filtrar" style="width: 100%;margin-top: 7%">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12">
            <div class="box tabla-admin">
                <!-- TABLA SUPERADMIN -->
                <table id="tabla-proveedor" class="table table-striped table-bordered base-style display table-responsive">
                    <thead>
                        <tr>
                            <th width="8%">ID</th>
                            <th width="12%">NOMBRE</th>
                            <th width="4%">DESCRIPCION</th>
                            <th width="18%">RUBRO</th>
                            <th width="20%">CORREO</th>
                            <th width="12%">CELULAR</th>
                            <th width="12%">TELEFONO</th>
                            <th width="10%">NOMBRE CONTACTO</th>
                            <th width="4%">RUT</th>
                            <th width="4%">DIRECCION</th>
                            <th width="4%">CIUDAD</th>
                            <th width="4%">EDITAR</th>
                            <th width="4%">ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>

        </div>



    </div>
</div>
