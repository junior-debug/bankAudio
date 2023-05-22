<script src="public/js/register.js"></script>
<script type="text/javascript">
function mayus(e) {
  e.value = e.value.toUpperCase();
}
</script>

  <div class="app-main__outer">
    <div class="app-main__inner">
      <div class="app-page-title">
        <div class="page-title-wrapper">
          <div class="page-title-heading">
            <div class="page-title-icon">
              <i class="pe-7s-users icon-gradient bg-premium-dark"></i>
            </div>
            <div>
              Usuarios
              <div class="page-title-subheading">
                Administracion de los usuarios del sistema
              </div>
            </div>
          </div>    
        </div>
      </div>
      <div class="main-card mb-3 card">
        <div class="card-body">
          <h5 class="card-title">Bandeja de usuarios del sistema</h5>
          <div>
            <div class="scroll-area-lg">
              <div class="scrollbar-container ps--active-y">
                <div class="card-body">
                    <div class="position-relative row form-group">
                      <label for="exampleEmail" class="col-sm-2 col-form-label">Nombre</label>
                      <div class="col-sm-10">
                        <input type="text" id="nombre" class="form-control" placeholder="Juan" name="nombre" maxlength="15" onkeyup="mayus(this);" required autofocus />
                      </div>
                    </div>
                    <div class="position-relative row form-group">
                      <label for="exampleEmail" class="col-sm-2 col-form-label">Apellido</label>
                      <div class="col-sm-10">
                        <input type="text" id="apellido" class="form-control" placeholder="Gomez" name="apellido" onkeyup="mayus(this);" maxlength="15" required />
                      </div>
                    </div>
                    <div class="position-relative row form-group">
                      <label for="exampleEmail" class="col-sm-2 col-form-label">Servicio</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="servicio" id="servicio" required>
                          <?php foreach ($servicio as $s) { ?>
                          <option value='0' disabled selected style='display:none;'>Servicio...</option>
                          <?php /*if ( $s['id_servicio'] != 4) {*/?>
                          <option value='<?php echo $s['id_servicio'];?>'><?php echo $s['descripcion'];?></option>
                        <?php }/*}*/?>
                        </select>
                      </div>
                    </div>
                    <div class="position-relative row form-group">
                      <label for="exampleEmail" class="col-sm-2 col-form-label">Tipo de usuario</label>
                      <div class="col-sm-10">
                          <select class="form-control" name="type_users" id="type_users" required>
                            <option value='0' disabled selected style='display:none;'>Seleccione...</option>
                            <option value='2'>ANALISTA</option>
                            <option value='3'>SUPERVISOR</option>
                            <option value='4'>COORDINADOR</option>
                            <option value='5'>GERENTE</option>
                            <option value='6'>EXTERNO</option>
                          </select>
                      </div>
                    </div>
                    <div class="position-relative row form-group">
                      <label for="exampleEmail" class="col-sm-2 col-form-label">Nombre de usuario</label>
                      <div class="col-sm-10">
                        <input type="text" id="user" class="form-control" placeholder="user" name="user" maxlength="10" required />
                      </div>
                    </div>
                    <button class="mt-2 btn btn-primary" id="btn-register" name="btn-register">Guardar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>