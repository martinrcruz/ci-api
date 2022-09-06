<div class="modal fade" id="modal-cliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">X</button>
      </div>
      <form id="formulario-cliente" class="form-element" autocomplete="off">
        <div class="modal-body">
          <div class="col-md-12">



            <div class="row mt-3 mb-3">

              <div class="col-sm-6">
                <div class="form-group form-custom-icon-left">
                  <span class="form-custom-icon"><i class="fas fa-pen"></i></span>
                  <label for="form-cliente-nombre" class="custom-label">Nombre: </label>

                  <input type="text" name="nombre" class="form-control" id="form-cliente-nombre" maxlength="200" />
                </div>
              </div>

              <div class="col-sm-6 form-actions">
                <div class="form-group form-custom-icon-left">
                  <span class="form-custom-icon"><i class="fa fa-pen"></i></span>
                  <label for="form-cliente-apellio" class="custom-label">Apellido: </label>
                  <input type="telefono" name="apellio" class="form-control" id="form-cliente-apellio" maxlength="200" required />
                </div>
              </div>
            </div>


            <div class="row mt-3 mb-3">

              <div class="col-sm-12">
                <div class="form-group form-custom-icon-left">
                  <span class="form-custom-icon"><i class="fas fa-pen"></i></span>
                  <label for="form-cliente-rut" class="custom-label">Rut: </label>
                  <input type="text" name="rut" class="form-control" id="form-cliente-rut" maxlength="50" required />
                </div>
              </div>
            </div>

            <div class="row mt-3 mb-3">

              <div class="col-sm-4 form-actions">
                <div class="form-group form-custom-icon-left">
                  <span class="form-custom-icon"><i class="fas fa-pen"></i></span>
                  <label for="form-cliente-empresa" class="custom-label">Empresa: </label>
                  <input type="text" name="empresa" class="form-control" id="form-cliente-empresa" maxlength="50" required />
                </div>
              </div>



              <div class="col-sm-8">
                <div class="form-group form-custom-icon-left">
                  <span class="form-custom-icon"><i class="fa fa-envelope"></i></span>
                  <label for="form-cliente-correo" class="custom-label">Correo: </label>
                  <input type="text" name="correo" class="form-control" id="form-cliente-correo" maxlength="150" required />
                </div>
              </div>
            </div>


            <div class="row mt-3 mb-3">

              <div class="col-sm-6">
                <div class="form-group form-custom-icon-left">
                  <span class="form-custom-icon"><i class="fas fa-mobile"></i></span>
                  <label for="form-cliente-celular" class="custom-label">Celular</label>

                  <input type="text" name="celular" class="form-control" id="form-cliente-celular" maxlength="20" />
                </div>
              </div>

              <div class="col-sm-6 form-actions">
                <div class="form-group form-custom-icon-left">
                  <span class="form-custom-icon"><i class="fa fa-phone"></i></span>
                  <label for="form-cliente-telefono" class="custom-label">Telefono</label>
                  <input type="telefono" name="telefono" class="form-control" id="form-cliente-telefono" maxlength="100" required />
                </div>
              </div>
            </div>






            <div class="row mt-3 mb-3">

              <div class="col-sm-12">
                <div class="form-group form-custom-icon-left">
                  <span class="form-custom-icon"><i class="fa fa-pen"></i></span>
                  <label for="form-cliente-nombre-observacion" class="custom-label">Observacion</label>
                  <textarea type="form-cliente-observacion" name="form-cliente-observacion" class="form-control" id="form-cliente-observacion" style="height: 80px;" required></textarea>
                </div>
              </div>

            </div>


          </div>
          <div class="row mt-3 mb-3">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 text-center">
              <input type='hidden' id="form-cliente-id" />
              <button type="submit" class="btn btn-info mt-4 button-title" id="agregar-cliente">Agregar cliente</button>
            </div>
            <div class="col-sm-3"></div>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>