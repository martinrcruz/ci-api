<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1 class="text-white">
            Mantenedor
            <small class="sub-info text-white">Gestión de Actividades</small>

        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="breadcrumb-item active"><a href="<?= base_url() ?>actividad">Actividades</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Actividades</h3>
                            <button type="button" class="btn btn-info" id="btn-actividad-agregar-actividad" style="float:right;padding: 6;"><i class="fa fa-plus"></i> Agregar <span class="sub-info">Actividad</span></button>
                        </div>
                        <div class="box-body">
                            <div class="">
                                <table id="tabla_actividad" class="table table-striped table-bordered base-style display table-responsive">
                                    <thead>
                                        <tr>
                                            <th width="100%">Actividad</th>
                                            <th width="20%">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->