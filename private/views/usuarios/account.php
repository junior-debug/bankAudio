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
              Mi cuenta
              <div class="page-title-subheading">
                En este panel podra realizar la actualización de la contraseña
              </div>
            </div>
          </div>    
        </div>
      </div>
      <div class="main-card mb-3 card">
        <div class="card-body">
          <h5 class="card-title">Datos del usuario</h5>
          <div>
            <div class="scroll-area-lg">
              <div class="scrollbar-container ps--active-y">
                <div class="card-body">
                    <div class="position-relative row form-group">
                      <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                      <div class="col-sm-10">
                        <input type="text" id="nombre" class="form-control" name="nombre" value="<?=$_SESSION['nombre']?>"disabled />
                      </div>
                    </div>
                    <div class="position-relative row form-group">
                      <label for="apellido" class="col-sm-2 col-form-label">Apellido</label>
                      <div class="col-sm-10">
                        <input type="text" id="apellido" class="form-control" name="apellido" value="<?=$_SESSION['apellido']?>"disabled />
                      </div>
                    </div>
                    <div class="position-relative row form-group">
                      <label for="servicio" class="col-sm-2 col-form-label">Servicio</label>
                      <div class="col-sm-10">
                        <!--  <input type="text" id="servicio" class="form-control" name="servicio" value="<?=$servicio?>"disabled />  -->
                        <?php foreach ($servicio as $s) {
                            if ( $_SESSION['cod_serv'] == $s['id_servicio']) {
                          ?>
                            <input type="text" id="servicio" class="form-control" name="servicio" value="<?php echo $s['descripcion'];?>" disabled />

                            <!-- <option value='<?php echo $s['id_servicio'];?>'><?php echo $s['descripcion'];?></option> -->
                        <?php }}?>
                      </div>
                    </div>
                    <div class="position-relative row form-group">
                      <label for="password" class="col-sm-2 col-form-label">Nueva contraseña</label>
                      <div class="col-sm-10">
                        <input type="password" id="password_" class="form-control" name="password_" maxlength="15" />
                      </div>
                    </div>
                    <input type="hidden" value="<?=$_SESSION['id']?>" id="userid">
                    <button class="mt-2 btn btn-primary" id="btn-update" name="btn-update">Guardar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>