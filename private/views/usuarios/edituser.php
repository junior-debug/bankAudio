<script src="public/js/register.js"></script>
 <div class="app-main__outer">
    <div class="app-main__inner">
      <div class="app-page-title">
        <div class="page-title-wrapper">
          <div class="page-title-heading">
            <div class="page-title-icon">
              <i class="pe-7s-users icon-gradient bg-premium-dark"></i>
            </div>
            <div>
              Edición
              <div class="page-title-subheading">
                Mantenimiento de usuarios
              </div>
            </div>
          </div>    
        </div>
      </div>
      <div class="main-card mb-3 card">
        <div class="card-body">
          <h5 class="card-title">Datos del usuario</h5>
          <div>
            <div class="form-row">
                <div class="col-md-6">
                  <div class="position-relative form-group">
                    <label class="form-group-addon">Nombre</label>
                    <input type="text" class="form-control" aria-describedby="nombre" name="nombre" id="nombre" value="<?=$nombre?>"/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="position-relative form-group">
                    <label class="form-group-addon">Apellido</label>
                    <input type="text" class="form-control" aria-describedby="apellido"  name="apellido" id="apellido" value="<?=$apellido?>" />
                  </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                  <div class="position-relative form-group">
                    <label class="form-group-addon">Status</label>
                    <select class='selectpicker show-menu-arrow show-tick form-control' name="status" id="status">
                      <option value='ACTIVO' <?=$a?> >ACTIVO</option>
                      <option value='INACTIVO' <?=$b?> >INACTIVO</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="position-relative form-group">
                    <label class="form-group-addon">Servicio</label>
                    <select class='selectpicker show-menu-arrow show-tick form-control' name="servicio" id="servicio">
                      <?php foreach ($servicio as $s) { ?>
                      <option value='0' selected style='display:none;'><?php echo $cliente;?></option>
                      <option value='<?php echo $s['id_servicio'];?>'><?php echo $s['descripcion'];}?></option>
                    </select>
                  </div>
                </div>
              </div>
              <input type="hidden" id="userid" value="<?=$id_user?>">
              <input type="button" class="btn btn-large btn-success" aria-describedby="update" id="update" value="Actualizar" />
              <input type="button" class="btn btn-large btn-info" aria-describedby="password" id="password" value="Reiniciar Contraseña" />
              <a href="?view=usuarios&mode=index" class="btn btn-medium btn-success">Volver</a>
          </div>
        </div>
      </div>
    </div>    
  </div>