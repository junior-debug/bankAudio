<?php
include(PUBLIC_DIR.'general/session.php');
if(empty($_SESSION)){header('location:index.php');}else{
	include_once(MODEL_DIR.'usuariosModel.php');
	$conexion = new database();
	if (isset($_GET['mode'])) {
		switch ($_GET['mode']) {
			case 'index':
					$listUser = $conexion->listUser();
					include(PUBLIC_DIR.'general/header.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'usuarios/index.php');
					include(PUBLIC_DIR.'general/footer.php');
			break;
	#----------------------------------------------------------	
			case 'new':
					$servicio = $conexion->servicio();
					include(PUBLIC_DIR.'general/header.php');
					include(PUBLIC_DIR.'general/navbar.php');
					include(HTML_DIR.'usuarios/newuser.php');
					include(PUBLIC_DIR.'general/footer.php');
			break;
	#----------------------------------------------------------	
			case 'registro':
				$nombre 	= $_POST['nombre'];
				$apellido 	= $_POST['apellido'];
				$user 		= $_POST['user'];
				$pass 		= md5(123456);
				$servicio 	= $_POST['servicio'];
				$type_users = $_POST['type_users'];

				$registro = $conexion->newUser($nombre,$apellido,$user,$pass,$type_users,$servicio);
				if ($registro){
					$json['response'] = 'true';
					echo json_encode($json);
				}else{
					$json['response'] = 'false';
					echo json_encode($json);
				}
			break;
	#----------------------------------------------------------	
			case 'edituser':
				$id_user = $_GET['id'];
				$registro = $conexion->editUser($id_user);
				foreach ($registro as $u) {
					$user 		= $u['user'];
					$nombre 	= $u['nombre'] ;
					$apellido 	= $u['apellido'];
					$rol 		= $u['type_user'];
					$status 	= $u['status'];
					$cliente	= $u['servicio'];
				}
				if($status = 'ACTIVO'){$b="";$a="selected";}else{$a="";$b="selected";}
				include(PUBLIC_DIR.'general/header.php');
				include(PUBLIC_DIR.'general/navbar.php');
				$servicio = $conexion->servicio();
				include(HTML_DIR.'usuarios/edituser.php');
				include(PUBLIC_DIR.'general/footer.php');
			break;
	#-----------------------------------------------------------
			case 'update':
				$id = $_POST['userid'];
				$nombre = $_POST['nombre'];
				$apellido = $_POST['apellido'];
				$status = $_POST['status'];
				$cliente = $_POST['servicio'];

				$update = $conexion->updateUser($id,$nombre,$apellido,$status,$cliente);
				
				if ($update){
					$json['response'] = 'true';
					echo json_encode($json);
				}else{
					$json['response'] = 'false';
					echo json_encode($json);
				}
			break;
	#-----------------------------------------------------------
			case 'password':
				$id = $_POST['userid'];
				$newpass = md5('123456');
				$password = $conexion->updatePass($id,$newpass);

				if ($password){
					$json['response'] = 'true';
					echo json_encode($json);
				}else{
					$json['response'] = 'false';
					echo json_encode($json);
				}
			break;
	#-----------------------------------------------------------
			case 'account':
				/*if($_SESSION['cod_serv'] == 1){ 
					$servicio = "HERBALIFE";
				}else{ 
					$servicio = "CALL MY MOM";
				}*/
				$servicio = $conexion->servicio();
				include(PUBLIC_DIR.'general/header.php');
				include(PUBLIC_DIR.'general/navbar.php');
				include(HTML_DIR.'usuarios/account.php');
				include(PUBLIC_DIR.'general/footer.php');
			break;
	#-----------------------------------------------------------
			case 'password_':
				$id = $_POST['userid'];
				$newpass = md5($_POST['password']);
				$password = $conexion->updatePass($id,$newpass);

				if ($password){
					$json['response'] = 'true';
					echo json_encode($json);
				}else{
					$json['response'] = 'false';
					echo json_encode($json);
				}
			break;
	#-----------------------------------------------------------
				default:
					header('location:'.HTML_DIR.'error.html');
			break;
		}
	}
}
?>