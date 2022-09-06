<div class="modal fade" id="modal-usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">X</button>
      </div>
      <form id="formulario-proveedor" class="form-element" autocomplete="off">
        <div class="modal-body">
          <div class="col-md-12">




            <div class="row mt-3 mb-3">
              <div class="col-sm-4">
                <div class="form-group form-custom-icon-left">
                  <span class="form-custom-icon"><i class="fas fa-pen"></i></span>
                  <label for="form-proveedor-nombre" class="custom-label">Nombre: </label>
                  <input type="text" name="nombre" class="form-control" id="form-proveedor-nombre" maxlength="50" required />
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-custom-icon-left">
                  <span class="form-custom-icon"><i class="fas fa-pen"></i></span>
                  <label for="form-proveedor-descripcion" class="custom-label">Apellido Paterno: </label>
                  <input type="text" name="nombre" class="form-control" id="form-proveedor-nombre" maxlength="50" required />
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-custom-icon-left">
                  <span class="form-custom-icon"><i class="fas fa-pen"></i></span>
                  <label for="form-proveedor-nombre" class="custom-label">Apellido Materno: </label>
                  <input type="text" name="nombre" class="form-control" id="form-proveedor-nombre" maxlength="50" required />
                </div>
              </div>


            </div>


            <div class="row mt-3 mb-3">

              <div class="col-sm-4 form-actions">
                <div class="form-group form-custom-icon-left">
                  <span class="form-custom-icon"><i class="fas fa-pen"></i></span>
                  <label for="form-proveedor-rubro" class="custom-label">Nombre de usuario: </label>
                  <input type="text" name="rubro" class="form-control" id="form-proveedor-rubro" maxlength="50" required />
                </div>
              </div>



              <div class="col-sm-8">
                <div class="form-group form-custom-icon-left">
                  <span class="form-custom-icon"><i class="fa fa-envelope"></i></span>
                  <label for="form-proveedor-correo" class="custom-label">Correo: </label>
                  <input type="text" name="correo" class="form-control" id="form-proveedor-correo" maxlength="15" required />
                </div>
              </div>
            </div>



            <div class="row mt-3 mb-3">

              <div class="col-sm-6">
                <div class="form-group form-custom-icon-left">
                  <span class="form-custom-icon"><i class="fa fa-user"></i></span>
                  <label for="form-proveedor-nombre-contacto" class="custom-label">Contrasena: </label>
                  <input type="nombre-contacto" name="nombre-contacto" class="form-control" id="form-proveedor-nombre-contacto" maxlength="100" required />
                </div>
              </div>


              <div class="col-sm-6">
                <div class="form-group form-custom-icon-left">
                  <span class="form-custom-icon"><i class="fa fa-building"></i></span>
                  <label for="form-proveedor-rut-empresa" class="custom-label">Confirmar contrasena: </label>
                  <input type="rut-empresa" name="rut-empresa" class="form-control" id="form-proveedor-rut-empresa" maxlength="100" required />
                </div>
              </div>
            </div>


  
          </div>
          <div class="row mt-3 mb-3">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 text-center">
              <input type='hidden' id="form-proveedor-id" />
              <button type="submit" class="btn btn-info mt-4 button-title"></button>
            </div>
            <div class="col-sm-3"></div>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>