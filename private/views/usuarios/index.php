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
                <table class="mb-0 table table-lg table-hover table-borderless">
                  <thead>
                    <tr>
                      <th style="text-align: center;"><strong>Usuario</strong></th>
                      <th style="text-align: center;"><strong>Nombre</strong></th>
                      <th style="text-align: center;"><strong>Apellido</strong></th>
                      <th style="text-align: center;"><strong>Servicio</strong></th>
                      <th style="text-align: center;"><strong>Estatus</strong></th>
                      <th style="text-align: center;"><strong>Editar</strong></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($listUser as $u) {?>
                    <tr align="center">
                      <td id="name"><?php echo $u['user'];?></td>
                      <td><?php echo $u['nombre'];?></td>
                      <td><?php echo $u['apellido'];?></td>
                      <td><?php echo $u['servicio'];?></td>
                      <td><?php echo $u['status'];?></td>
                      <td><a href="?view=usuarios&mode=edituser&id=<?php echo $u['id_user'];?>" name="edituser" id="edituser" class="btn btn-small btn-success"><span class="pe-7s-pen"></span></a></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>    
  </div>

</div>