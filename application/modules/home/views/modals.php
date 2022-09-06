<div id="modal-actividad" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-l">
        <div class="modal-content">
            <div class="modal-header mb-3">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="formulario-actividad" class="form-element" autocomplete="off">
                <div class="modal-body">
                    <div class="col-md-12">


                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-group form-custom-icon-left">
                                    <label for="form-actividad-nombre">Nombre Actividad</label>
                                    <span class="form-custom-icon"><i class="fa fa-pencil"></i></span>
                                    <input type="text" name="nombre" class="form-control" id="form-actividad-nombre" maxlength="50" required />
                                </div>
                            </div>
                            <div class="col-sm-1"></div>


                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>Area Actividad</label>
                                    <select class="form-control selectpicker" id="form-actividad-area-id" data-live-search="true" title="Elige el area relacionada" data-dropup-auto="false" data-size=15 required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>


                        </div>

                        <div class="row pt-4">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label id="label-actividad"></label>


                                    <table class="table" id="tabla-area-actividad">
                                        <thead>
                                            <tr>
                                                <th scope="col" width="20%">ID</th>
                                                <th scope="col" class="text-center">Nombre Area</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       
                                        </tbody>
                                    </table>

                                    
                                </div>
                            </div>
                            <div class="col-sm-1"></div>


                        </div>


                    </div>

                    <div class="row mt-3 mb-3">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <input type='hidden' id="form-actividad-id"/>
                            <button type="submit" class="btn btn-info btn-block mt-4 button-title"></button>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
</div>




<style>

</style>