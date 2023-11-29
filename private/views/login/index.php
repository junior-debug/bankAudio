<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=APP_TITLE ?></title>
    <link href="public/css/main.css" rel="stylesheet" type="text/css" />
    <link href="public/images/icon.png" rel="icon" type="image/png"/>
    <script src="public/js/jquery-3.2.1.min.js"></script>
    <script>
    //VALIDACION DEL NOMBRE DE USUARIO
    $(document).ready(function(){
      $('#username').change(function(){
        $.post('?view=session&mode=login',{user:$('#username').val()},function(respuesta){
          if (respuesta!=1) {
            $('#mensaje').show()
          }
          else{
            $('#mensaje').hide()
          }
        })
      })
      //}

    //VALIDACION DE LA CONTRASEÑA
       $('#session').click(function(){
          if ($('#username').val() === "" || $('#password').val() === "" ) {
            $('#mensaje3').show()
          }
          else{
            $('#mensaje3').hide()
            $.post('?view=session&mode=login_',{user:$('#username').val(),pass:$('#password').val()},function(confirm){
              if(confirm!=1){
                $('#mensaje2').show()
              }
              else{
                window.location='?view=llamadas&mode=index'
              }
            })
          }
        })
    })     
    </script>
    <style type="text/css">
      @import url('https://fonts.googleapis.com/css?family=Numans');
      .loginbox{
        margin-top: 200px;
      }

      .loginboxes{
        margin-top: 50px;
        margin-bottom: -180px;
      }
    </style>
  </head>

  <body style="background-color: #f0f0f0 !important;">
  <?php
  if($_SERVER['SERVER_NAME'] == 'app.mecadevelopment.com'){
    echo '<div class="loginboxes">
            <div class="container">
              <div class="row justify-content-md-center">
                  <img src="public/images/logo_meca.png" height="200px" width="220px">
              </div>
            </div>
          </div>';
  }else{
        echo '<div class="loginboxes">
            <div class="container">
              <div class="row justify-content-md-center">
                  <img src="public/images/logo_AUDIOS_PRC.png">
              </div>
            </div>
          </div>';
  }
  ?>
  <div class="loginbox">
    <div class="row justify-content-md-center">
      <div class="mb-2 col-md-4">
        <div class="main-card mb-3 card">
          <div class="card-body">
            <center><h1><strong>AUDIOS PRC333</strong></h1> </center>
            <fieldset>
              <div class="form-group">
               <input type='text' class="form-control" name="username" id='username' placeholder='Usuario' maxlength="10" required autofocus>
                <div id="mensaje" class="message" style="display:none; color:red;">El usuario no existe, por favor verifique.</div>
              </div>
              <div class="form-group">
               <input type='password' class="form-control" name="password" id='password' placeholder='Contraseña' maxlength="15" required>
               <div id="mensaje2" class="message" style="display:none; color: red;">La contraseña es invalida, por favor verifique.</div>
               <div id="mensaje3" class="message" style="display:none; color: red;">Por favor introduzca su usuario o contraseña.</div>
              </div>
              <input id="session" name="session" type="submit" class="btn mt-1 btn btn-primary btn-block" value="INGRESAR" />
            </fieldset>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!--div class="footer">
      <p style="text-align: center;">Este sitio es propiedad privada de PRC333 C.A. RIF: J-300661756-6</p>
      <p style="text-align: center;"><?=APP_COPY?></p>
    </div-->
  </body>
</html>
