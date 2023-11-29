<?php
include_once(MODEL_DIR . 'sessionModel.php');
$conexion   = new database();
if (isset($_GET['mode'])) {
	switch ($_GET['mode']) {
		case 'login':
			$u = $_POST['user'];
			$c = $conexion->sessionLogin($u);
			if (!empty($c)) {
				$user = $c[0][4];
				echo 1;
			} else {
				echo 2;
			}
			break;
			#_______________________________________________________________
		case 'login_':
			$u = $_POST['user'];
			$p = $_POST['pass'];
			$p_md5 = md5($p);

			$c = $conexion->sessionNew($u, $p_md5);

			if (!empty($c)) {

				$id   			= $c[0][0];
				$nombre 		= $c[0][1];
				$apellido 		= $c[0][2];
				$user 			= $c[0][3];
				$tipo 			= $c[0][5];
				$status 		= $c[0][6];
				$cod_serv		= $c[0][7];  // 1:herbalife 2:SimpleTv 3: amex 4:admin 5:simpletvVENtas

				if ($cod_serv == 1) {
					$name_codig = 'HERBALIFE';
				} elseif ($cod_serv == 2) {
					$name_codig = 'SIMPLETV';
				} elseif ($cod_serv == 3) {
					$name_codig = 'AMEX';
				} elseif ($cod_serv == 4) {
					$name_codig = 'ADMIN';
				} elseif ($cod_serv == 5) {
					$name_codig = 'FASTPAYMENT';
				} elseif ($cod_serv == 6) {
					$name_codig = 'BANCAASISTENCIA';
				} elseif ($cod_serv == 7) {
					$name_codig = 'COCACOLA';
				} elseif ($cod_serv == 8) {
					$name_codig = 'LAGIRALDA';
				} elseif ($cod_serv == 9) {
					$name_codig = 'MOVILNET';
				} elseif ($cod_serv == 10) {
					$name_codig = 'CEGESA';
				} else {
					$name_codig = 'ADMINOTRO';
				}

				if ($status == 'INACTIVO') {
					echo 3;
				} else {
					session_start();
					$_SESSION['id']				= $id;
					$_SESSION['nombre'] 		= $nombre;
					$_SESSION['apellido']		= $apellido;
					$_SESSION['user'] 			= $user;
					$_SESSION['type_user']		= $tipo;
					$_SESSION['cod_serv']		= $cod_serv;
					$_SESSION['name_cod_serv']	= $name_codig;
					echo 1;
				}
			} else {
				echo 2;
			}
			break;
			#_________________________________________________________________________________
		case 'disconect':
			include(PUBLIC_DIR . 'general/session.php');
			print_r($_SESSION);
			session_destroy();
			header('location:index.php');
			break;
			#_________________________________________________________________________________
		default:
			header('location:' . HTML_DIR . 'error.html');
			break;
	}
} else {
	include(HTML_DIR . 'login/index.php');
}
