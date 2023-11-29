<?php
include(PUBLIC_DIR . 'general/session.php');
if (empty($_SESSION)) {
	header('location:index.php');
} else {
	include_once(MODEL_DIR . 'llamadasModel.php');
	$conexion = new database();

	if (isset($_GET['mode'])) {

		function archivosACoincidir($directorio, $cedula_Tlf_filtro)
		{
			if (is_dir($directorio)) {
				if ($dh = opendir($directorio)) {
					//echo '<br> dIrecTORIo: '.$directorio.'<br>';

					while (($file = readdir($dh)) !== false) {
						//esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
						//mostraría tanto archivos como directorios
						//echo "<br>Nombre de archivo: $file : Es un: " . filetype($directorio . $file);
						if (!is_dir($directorio . $file) && $file != "." && $file != "..") {
							//solo si es archivo, distinto que "." y ".."
							$pos = strstr($file, $cedula_Tlf_filtro);
							if ($pos) {
								$coincidencia[] = $file;
							}
							//$mystring = 'abc';
							//$findme   = 'a';
							//$pos = strpos($mystring, $findme);
						}
					}
					closedir($dh);
				}
			}

			if ($coincidencia) {
				$resultFiltroCedula = 1; // 1 hay coincidencia, 0 no hay
				/*foreach ($coincidencia as $key) {
						echo ' las que coincidieron son: '. $key.'<br>';
					}*/
			} else {
				$resultFiltroCedula = 0; // 1 hay coincidencia, 0 no hay
				//echo ' no hubo coincidencia <br>';
			}

			return $coincidencia;
		}

		switch ($_GET['mode']) {
			case 'index':
				var_dump($_SESSION["type_user"]);

				$date 					= "0";
				$directorio  			= "";
				$resultados_consult 	= "";
				$ruta = "public/audiobank-vicidial/";

				//echo '<br> RUta: '.$ruta.'<br>';
				if (is_dir($ruta)) {
					if ($dh = opendir($ruta)) {
						//echo '<br> RUta: '.$ruta.'<br>';
						while (($file = readdir($dh)) !== false) {
							//esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
							//mostraría tanto archivos como directorios
							//echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);
							if (is_dir($ruta . $file) && $file != "." && $file != "..") {
								//solo si el archivo es un directorio, distinto que "." y ".."
								//echo "<br>Directorio: $ruta$file";
								//echo '<br> Archivo: '.$file.'<br>';	
								$directoriosPresentesService1_[] = $file;
								//listar_directorios_ruta($ruta . $file . "/");
							}
						}
						closedir($dh);
					}
				}

				if ($directoriosPresentesService1_) {
					$directorioUno = $directoriosPresentesService1_;
				} else {
					$directorioUno = 99;
				}

				if (file_exists($ruta)) {
					echo "The file $ruta exists";
				} else {
					echo "The file $ruta does not exist";
				}


				include(PUBLIC_DIR . 'general/header.php');
				include(PUBLIC_DIR . 'general/navbar.php');
				include(HTML_DIR . 'llamadas/index.php');
				include(PUBLIC_DIR . 'general/footer.php');
				break;
				#--------------------------------------------------------------- 
			case 'result':
				$servicioSelect 		= 	$_POST['servicio_index'];
				$servicioSelectDos 		= 	$_POST['directorioDos'];
				$CampanaDirectorio 		= 	$_POST['CampanaDirectorio'];
				$dataFecha 				= 	$_POST['date'];
				$cedula_filtro 			= 	$_POST['inputCedula_filtroForm'];
				$telefono_filtro 		= 	$_POST['inputTelefono_filtroForm'];
				$hora_filtro 			= 	$_POST['inputHora_filtroForm'];
				$seg_filtro 			= 	$_POST['inputHoraSeg_filtroForm'];
				$HoraSeg_filtro         =   $_POST['inputTiempo_filtroForm'];

				if ($hora_filtro) {
					$horaGeneral 			= 	$hora_filtro . ':' . $seg_filtro;
				} else {
					$horaGeneral = '00:00:00';
				}
				//    audiobank-vicidial/simpletv/simpletv-ventas/2022/04/12/STVVENTA

				//		20220412-104615_04121665261_STVVENTA_26122302-all.mp3

				// 		02126264101==904120921644==12-Apr-2022==17:08:19.wav

				//echo ' simple: ' .$servicioSelect. '<br> --> simple-atc:  '.$servicioSelectDos. '<br> -->fecha: '.$dataFecha. '<br> --> STVIVR/STVSOP:  '. $CampanaDirectorio. '<br> --> cedula: '.$cedula_filtro . '<br> --> TLF:  '.$telefono_filtro. '<br> --> HORA: '.$horaGeneral . '<br><br>';

				//simpletv/simpletv-atc/2022/04/12/STVSOP
				$date = str_replace("-", "/", $dataFecha) . '/';
				$directorio = "public/audiobank-vicidial/" . $servicioSelect . "/" . $servicioSelectDos . "/" . $date . "" . $CampanaDirectorio . "/";
				//RUTA PUBLIC/AUDIOBANK-VICIDIAL/SIMPLETV/SIMPLETV-ATC/2022/04/26/STVGROSS/
				//echo '<br>'. $directorio. '<br>';


				// BLOQUE DEL RESULT_	
				if (!empty($cedula_filtro) && empty($telefono_filtro) && empty($hora_filtro)) {   //echo '<br> / HAY cedula /  NO HAY tlf / NO HAY hora  <br>';
					if ($servicioSelect != '0' &&  $servicioSelectDos != "" &&  $dataFecha != "" &&  $CampanaDirectorio != "") {
						$resultados_consult 	= archivosACoincidir($directorio, $cedula_filtro);
						$abc = 88;
					} else {
						//echo ' 16869225  los 3 directorio vaciosss <br>';
						$abc = 100;
						exec("locate  $cedula_filtro", $resultado);
						for ($i = 0; $i < count($resultado); $i++) {
							$pos = strstr($resultado[$i], 'audiobank-vicidial');
							if ($pos) {
								$resultados_consult[] = 'public' . $resultado[$i];
								//echo 'public'.$resultado[$i].'<br>';
							}
						}
					}
				} else if (empty($cedula_filtro) && !empty($telefono_filtro) && empty($hora_filtro)) {  //echo ' / HAY tlf /  NO HAY cedula /  NO HAY hora <br>';
					/*$resultados_consult 	= archivosACoincidir($directorio,$telefono_filtro);	
					$abc = 88;*/
					if ($servicioSelect != '0' &&  $servicioSelectDos != "" &&  $dataFecha != "" &&  $CampanaDirectorio != "") {
						$resultados_consult 	= archivosACoincidir($directorio, $telefono_filtro);
						$abc = 88;
					} else {
						//echo ' 16869225  los 3 directorio vaciosss <br>';
						$abc = 100;
						exec("locate  $telefono_filtro", $resultado);
						for ($i = 0; $i < count($resultado); $i++) {
							$pos = strstr($resultado[$i], 'audiobank-vicidial');
							if ($pos) {
								$resultados_consult[] = 'public' . $resultado[$i];
								//echo 'public'.$resultado[$i].'<br>';
							}
						}
					}
				} else if (empty($cedula_filtro) && empty($telefono_filtro) && !empty($hora_filtro)) {  //echo '  / HAY hora /   NO HAY cedula / NO HAY tlf  <br>';	
					/*$resultados_consult 	= archivosACoincidir($directorio,$hora_filtro);	
					$abc = 88;*/
					if ($servicioSelect != '0' &&  $servicioSelectDos != "" &&  $dataFecha != "" &&  $CampanaDirectorio != "") {
						$resultados_consult 	= archivosACoincidir($directorio, $hora_filtro);
						$abc = 88;
					} else {
						//echo ' 16869225  los 3 directorio vaciosss <br>';
						$abc = 100;
						exec("locate  $hora_filtro", $resultado);
						for ($i = 0; $i < count($resultado); $i++) {
							$pos = strstr($resultado[$i], 'audiobank-vicidial');
							if ($pos) {
								$resultados_consult[] = 'public' . $resultado[$i];
								//echo 'public'.$resultado[$i].'<br>';
							}
						}
					}
				} else if (empty($cedula_filtro) && empty($telefono_filtro) && empty($hora_filtro)) { // echo ' / NO HAY tlf / NO HAY cedula /  NO HAY hora  <br>';

					if (($servicioSelect != '0' || $servicioSelect != '') && ($servicioSelectDos != '0' || $servicioSelectDos != '') && $dataFecha != '' && $CampanaDirectorio != '') {

						$resultados_consult 	= $directorio;
						$abc = 99;
						$total_result = 0;
						if ($handle = opendir($resultados_consult)) {
							while ($entry = readdir($handle)) {
								if ($entry === "." || $entry === "..") {
								} else {
									//echo '<br> entryy: '.$entry.'<br>';
									$total_result = $total_result + 1;
								}
							}
							$countResult = $total_result;
						} else {
							$countResult = 0;
						}
						closedir($handle);
						//echo ' <br>'.$countResult.'<br>';
					} else {
					}
				} else if (!empty($cedula_filtro) && !empty($telefono_filtro) && empty($hora_filtro)) { // echo '  / HAY cedula /    HAY tlf / NO HAY hora  <br>';	
					$resultados_consultCedula 	= archivosACoincidir($directorio, $cedula_filtro);
					$resultados_consultTlf 		= strstr($resultados_consultCedula, $telefono_filtro);
					$abc = 88;

					if ($resultados_consultCedula) {
						for ($i = 0; $i < count($resultados_consultCedula); $i++) {
							$pos = strstr($resultados_consultCedula[$i], $telefono_filtro);
							if ($pos) {
								$resultados_consult[] = $resultados_consultCedula[$i];
								//echo $resultados_consultCedula[$i].'<br>';
							}
						}
					} else {
						$resultados_consult = 0;
					}
				} else if (!empty($cedula_filtro) && empty($telefono_filtro) && !empty($hora_filtro)) { // echo '  / HAY cedula /    HAY hora  / NO HAY tlf  <br>';	
					$resultados_consultCedula 	= archivosACoincidir($directorio, $cedula_filtro);
					$abc = 88;

					if ($resultados_consultCedula) {
						for ($i = 0; $i < count($resultados_consultCedula); $i++) {
							$pos = strstr($resultados_consultCedula[$i], $hora_filtro);
							if ($pos) {
								$resultados_consult[] = $resultados_consultCedula[$i];
								//echo $resultados_consultCedula[$i].'<br>';
							}
						}
					} else {
						$resultados_consult = 0;
					}
				} else if (empty($cedula_filtro) && !empty($telefono_filtro) && !empty($hora_filtro)) { // echo '  / HAY tlf /    HAY hora  / NO HAY cedula  <br>';	
					$resultados_consultTelefono 	= archivosACoincidir($directorio, $telefono_filtro);
					$abc = 88;

					if ($resultados_consultTelefono) {
						for ($i = 0; $i < count($resultados_consultTelefono); $i++) {
							$pos = strstr($resultados_consultTelefono[$i], $hora_filtro);
							if ($pos) {
								$resultados_consult[] = $resultados_consultTelefono[$i];
								//echo $resultados_consultCedula[$i].'<br>';
							}
						}
					} else {
						$resultados_consult = 0;
					}
				} else if (!empty($cedula_filtro) && !empty($telefono_filtro) && !empty($hora_filtro)) { // echo '  / HAY tlf /    HAY hora  /  HAY cedula  <br>';	
					$resultados_consultCedula 	= archivosACoincidir($directorio, $cedula_filtro);
					$abc = 88;

					if ($resultados_consultCedula) {
						for ($i = 0; $i < count($resultados_consultCedula); $i++) {
							$pos = strstr($resultados_consultCedula[$i], $hora_filtro);

							if ($pos) {
								$pos_ = strstr($resultados_consultCedula[$i], $telefono_filtro);
								if ($pos_) {
									$resultados_consult[] = $resultados_consultCedula[$i];
									//echo $resultados_consultCedula[$i].'<br>';
								}
							}
						}
					} else {
						$resultados_consult = 0;
					}
				}






				// END BLOQUE DEL RESULT_	
				// BLOQUE PARA EL INDEX
				$ruta = "public/audiobank-vicidial/";
				//   /audiobank-vicidial/simpletv/simpletv-atc/2022/04/12/STVSOP
				//echo '<br> RUta: '.$ruta.'<br>';
				if (is_dir($ruta)) {
					if ($dh = opendir($ruta)) {
						//echo '<br> RUta: '.$ruta.'<br>';
						while (($file = readdir($dh)) !== false) {
							//esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
							//mostraría tanto archivos como directorios
							//echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);
							if (is_dir($ruta . $file) && $file != "." && $file != "..") {
								//solo si el archivo es un directorio, distinto que "." y ".."
								//echo "<br>Directorio: $ruta$file";
								//echo '<br> Archivo: '.$file.'<br>';	
								$directoriosPresentesService1_[] = $file;
								//listar_directorios_ruta($ruta . $file . "/");
							}
						}
						closedir($dh);
					}
				}

				if ($directoriosPresentesService1_) {
					$directorioUno = $directoriosPresentesService1_;
				} else {
					$directorioUno = 99;
				}
				// END BLOQUE PARA EL INDEX
				include(PUBLIC_DIR . 'general/header.php');
				include(PUBLIC_DIR . 'general/navbar.php');
				include(HTML_DIR . 'llamadas/index.php');
				include(PUBLIC_DIR . 'general/footer.php'); /*  */
				break;







				#--------------------------------------------------------------- 
			case 'result_prueba':
				$servicioSelect 		= 	'simpletv';		// $_POST['servicio_index'];
				$servicioSelectDos 		= 	'simpletv-atc';		// $_POST['directorioDos'];
				$CampanaDirectorio 		= 	'';		// $_POST['CampanaDirectorio'];
				$dataFecha 				= 	'';		// $_POST['date'];
				$cedula_filtro 			= 	'';		// $_POST['inputCedula_filtroForm'];
				$telefono_filtro 		= 	''; //'04121665261';		// $_POST['inputTelefono_filtroForm'];
				$hora_filtro 			= 	'';		// $_POST['inputHora_filtroForm'];
				$seg_filtro 			= 	'';		// $_POST['inputHoraSeg_filtroForm'];

				$fechaSelect		= str_replace("-", "/", $dataFecha/*$_POST['fechaSelect']*/) . '/';

				if ($hora_filtro) {
					$horaGeneral 			= 	$hora_filtro . ':' . $seg_filtro;
				} else {
					$horaGeneral = '00:00:00';
				}
				/*			
--> simple: fastpayment
--> simple-atc: fastpayment-ventas
--> fecha:
--> STVIVR/STVSOP:
--> cedula:
--> TLF:
--> HORA: 00:00:00
*/


				echo ' simple: ' . $servicioSelect . '<br> --> simple-atc:  ' . $servicioSelectDos . '<br> -->fecha: ' . $dataFecha . '<br> --> STVIVR/STVSOP:  ' . $CampanaDirectorio . '<br> --> cedula: ' . $cedula_filtro . '<br> --> TLF:  ' . $telefono_filtro . '<br> --> HORA: ' . $horaGeneral . '<br><br>';

				//simpletv/simpletv-atc/2022/04/12/STVSOP
				$date = str_replace("-", "/", $dataFecha) . '/';
				$directorio = "public/audiobank-vicidial/" . $servicioSelect . "/" . $servicioSelectDos . "/" . $date . "" . $CampanaDirectorio . "/";
				//RUTA PUBLIC/AUDIOBANK-VICIDIAL/SIMPLETV/SIMPLETV-ATC/2022/04/26/STVGROSS/
				//echo '<br>'. $directorio. '<br>';


				// BLOQUE DEL RESULT_	
				if (!empty($cedula_filtro) && empty($telefono_filtro) && empty($hora_filtro)) {
					echo '<br> / HAY cedula /  NO HAY tlf / NO HAY hora  <br>';
					if ($servicioSelect != '0' &&  $servicioSelectDos != "" &&  $dataFecha != "" &&  $CampanaDirectorio != "") {
						$resultados_consult 	= archivosACoincidir($directorio, $cedula_filtro);
						$abc = 88;
					} else {
						//echo ' 16869225  los 3 directorio vaciosss <br>';
						$abc = 100;
						exec("locate  $cedula_filtro", $resultado);
						for ($i = 0; $i < count($resultado); $i++) {
							$pos = strstr($resultado[$i], 'audiobank-vicidial');
							if ($pos) {
								$resultados_consult[] = 'public' . $resultado[$i];
								//echo 'public'.$resultado[$i].'<br>';
							}
						}
					}
				} else if (empty($cedula_filtro) && !empty($telefono_filtro) && empty($hora_filtro)) {
					echo ' / HAY tlf /  NO HAY cedula /  NO HAY hora <br>';
					/*$resultados_consult 	= archivosACoincidir($directorio,$telefono_filtro);	
					$abc = 88;*/
					if ($servicioSelect != '0' &&  $servicioSelectDos != "" &&  $dataFecha != "" &&  $CampanaDirectorio != "") {
						$resultados_consult 	= archivosACoincidir($directorio, $telefono_filtro);
						$abc = 88;
					} else {
						//echo ' 16869225  los 3 directorio vaciosss <br>';
						$abc = 100;
						exec("locate  $telefono_filtro", $resultado);
						for ($i = 0; $i < count($resultado); $i++) {
							$pos = strstr($resultado[$i], 'audiobank-vicidial');
							if ($pos) {
								$resultados_consult[] = 'public' . $resultado[$i];
								//echo 'public'.$resultado[$i].'<br>';
							}
						}
					}
				} else if (empty($cedula_filtro) && empty($telefono_filtro) && !empty($hora_filtro)) {
					echo '  / HAY hora /   NO HAY cedula / NO HAY tlf  <br>';
					/*$resultados_consult 	= archivosACoincidir($directorio,$hora_filtro);	
					$abc = 88;*/
					if ($servicioSelect != '0' &&  $servicioSelectDos != "" &&  $dataFecha != "" &&  $CampanaDirectorio != "") {
						$resultados_consult 	= archivosACoincidir($directorio, $hora_filtro);
						$abc = 88;
					} else {
						//echo ' 16869225  los 3 directorio vaciosss <br>';
						$abc = 100;
						exec("locate  $hora_filtro", $resultado);
						for ($i = 0; $i < count($resultado); $i++) {
							$pos = strstr($resultado[$i], 'audiobank-vicidial');
							if ($pos) {
								$resultados_consult[] = 'public' . $resultado[$i];
								//echo 'public'.$resultado[$i].'<br>';
							}
						}
					}
				} else if (empty($cedula_filtro) && empty($telefono_filtro) && empty($hora_filtro)) {

					echo ' / NO HAY tlf / NO HAY cedula /  NO HAY hora *****  / NO HAY tlf / NO HAY cedula /  NO HAY hora  <br>';

					if (($servicioSelect != '0' || $servicioSelect != '') && ($servicioSelectDos != '0' || $servicioSelectDos != '') && $dataFecha != '' && $CampanaDirectorio != '') {
						$resultados_consult 	= $directorio;
						$abc = 99;

						$total_result = 0;
						if ($handle = opendir($resultados_consult)) {
							while ($entry = readdir($handle)) {
								if ($entry === "." || $entry === "..") {
								} else {
									echo '<br>' . $entry . '<br>';
									$total_result = $total_result + 1;
								}
							}
							$countResult = $total_result;
						} else {
							$countResult = 0;
						}
						closedir($handle);
						//echo ' <br>'.$countResult.'<br>';
					} else {
						$abc = 95959959595;
					}

					echo ' <br> ***************************************** <br>';
					echo $abc . '<br><br>';
				} else if (!empty($cedula_filtro) && !empty($telefono_filtro) && empty($hora_filtro)) {
					echo '  / HAY cedula /    HAY tlf / NO HAY hora  <br>';
					$resultados_consultCedula 	= archivosACoincidir($directorio, $cedula_filtro);
					$resultados_consultTlf 		= strstr($resultados_consultCedula, $telefono_filtro);
					$abc = 88;

					if ($resultados_consultCedula) {
						for ($i = 0; $i < count($resultados_consultCedula); $i++) {
							$pos = strstr($resultados_consultCedula[$i], $telefono_filtro);
							if ($pos) {
								$resultados_consult[] = $resultados_consultCedula[$i];
								//echo $resultados_consultCedula[$i].'<br>';
							}
						}
					} else {
						$resultados_consult = 0;
					}
				} else if (!empty($cedula_filtro) && empty($telefono_filtro) && !empty($hora_filtro)) {
					echo '  / HAY cedula /    HAY hora  / NO HAY tlf  <br>';
					$resultados_consultCedula 	= archivosACoincidir($directorio, $cedula_filtro);
					$abc = 88;

					if ($resultados_consultCedula) {
						for ($i = 0; $i < count($resultados_consultCedula); $i++) {
							$pos = strstr($resultados_consultCedula[$i], $hora_filtro);
							if ($pos) {
								$resultados_consult[] = $resultados_consultCedula[$i];
								//echo $resultados_consultCedula[$i].'<br>';
							}
						}
					} else {
						$resultados_consult = 0;
					}
				} else if (empty($cedula_filtro) && !empty($telefono_filtro) && !empty($hora_filtro)) {
					echo '  / HAY tlf /    HAY hora  / NO HAY cedula  <br>';
					$resultados_consultTelefono 	= archivosACoincidir($directorio, $telefono_filtro);
					$abc = 88;

					if ($resultados_consultTelefono) {
						for ($i = 0; $i < count($resultados_consultTelefono); $i++) {
							$pos = strstr($resultados_consultTelefono[$i], $hora_filtro);
							if ($pos) {
								$resultados_consult[] = $resultados_consultTelefono[$i];
								//echo $resultados_consultCedula[$i].'<br>';
							}
						}
					} else {
						$resultados_consult = 0;
					}
				} else if (!empty($cedula_filtro) && !empty($telefono_filtro) && !empty($hora_filtro)) {
					echo '  / HAY tlf /    HAY hora  /  HAY cedula  <br>';
					$resultados_consultCedula 	= archivosACoincidir($directorio, $cedula_filtro);
					$abc = 88;

					if ($resultados_consultCedula) {
						for ($i = 0; $i < count($resultados_consultCedula); $i++) {
							$pos = strstr($resultados_consultCedula[$i], $hora_filtro);

							if ($pos) {
								$pos_ = strstr($resultados_consultCedula[$i], $telefono_filtro);
								if ($pos_) {
									$resultados_consult[] = $resultados_consultCedula[$i];
									//echo $resultados_consultCedula[$i].'<br>';
								}
							}
						}
					} else {
						$resultados_consult = 0;
					}
				}


				print($resultados_consult);
				break;


































				#---------------------------------------------------------------
			case 'ServiceDos':
				$servicioUno = $_POST['servicioUno'];
				//echo $servicioSelect;
				//function listar_directorios_ruta($ruta){
				// abrir un directorio y listarlo recursivo

				//$directorio = "../../../../audiobank-vicidial/simpletv/".$servicioSelect."/";
				//echo '<br>'. $servicioSelect. ' --> '. $fechaSelect.'<br>';

				$ruta = "public/audiobank-vicidial/" . $servicioUno . '/';

				//echo '<br> RUta: '.$ruta.'<br>';

				if (is_dir($ruta)) {
					if ($dh = opendir($ruta)) {
						//echo '<br> RUta: '.$ruta.'<br>';
						while (($file = readdir($dh)) !== false) {
							//esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
							//mostraría tanto archivos como directorios
							//echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);
							if (is_dir($ruta . $file) && $file != "." && $file != "..") {
								//solo si el archivo es un directorio, distinto que "." y ".."
								//echo "<br>Directorio: $ruta$file";
								//echo '<br> Archivo: '.$file.'<br>';	
								$directoriosPresentesDos_[] = $file;
								//listar_directorios_ruta($ruta . $file . "/");
							}
						}
						closedir($dh);
					}

					if ($directoriosPresentesDos_) {
						$b  = 	'<select class="form-control" onchange="servicioSelectDos(this.value)"  id="directorioDos" name="directorioDos" class="form-control">
					              			<option selected value="0">Seleccione...</option>';
						foreach ($directoriosPresentesDos_ as $kesy) {
							$b 	=	$b . '<option value="' . utf8_encode($kesy) . '">' . utf8_encode($kesy) . '</option>';
						}
						$b 	= 	$b . '</select>';

						//echo '<br>' . $b . '<br>' ;


						$json['selectServicioDosDirectorio'] =	$b;
						$json['resultRuta'] =	1;  // 1 es una ruta válida
						$json['ruta_'] = $ruta;
						echo json_encode($json);
					} else {
						$b  = 	'<select class="form-control" onchange="servicioSelectDos(this.value)" required id="directorioDos" name="directorioDos" class="form-control">
					              			<option selected value="0">Seleccione...</option>';
						foreach ($directoriosPresentesDos_ as $kesy) {
							$b 	=	$b . '<option value="' . utf8_encode($kesy) . '">' . utf8_encode($kesy) . '</option>';
						}
						$b 	= 	$b . '</select>';

						$json['selectServicioDosDirectorio'] =	$b;
						$json['resultRuta'] =	1;  // 1 es una ruta válida
						$json['ruta_'] = $ruta;
						echo json_encode($json);
					}  /**/
				} else {
					//echo "<br>No es ruta valida";
					$json['selectServicioDosDirectorio'] =	"";
					$json['resultRuta'] =	0;	//0 no es una ruta valida
					$json['ruta_'] = $ruta;
					echo json_encode($json); /**/
				}

				break;
				#---------------------------------------------------------------
			case 'campanasSelect':
				$servicioSelect 	= $_POST['servicio'];
				$servicioSelectDos 	= $_POST['servicio2'];
				$fechaSelect 		= $_POST['fecha'];
				$fechaSelect		= str_replace("-", "/", $fechaSelect/*$_POST['fechaSelect']*/) . '/';

				//echo $servicioSelect;
				//function listar_directorios_ruta($ruta){
				// abrir un directorio y listarlo recursivo

				//$directorio = "../../../../audiobank-vicidial/simpletv/".$servicioSelect."/";
				//echo '<br>'. $servicioSelect. ' --> '. $fechaSelect.'<br>';

				$ruta = "public/audiobank-vicidial/" . $servicioSelect . "/" . $servicioSelectDos . "/" . $fechaSelect;
				//echo '<br> RUta: '.$ruta.'<br>';
				if (is_dir($ruta)) {
					if ($dh = opendir($ruta)) {
						while (($file_ = readdir($dh)) !== false) {
							if (is_dir($ruta . $file_) && $file_ != "." && $file_ != "..") {
								//___************************************************_________________	
								$ruta_ = $ruta . $file_;                //'STVRNI';
								//echo '<br> Ruta__; '.$ruta_.'<br><br>';
								$totalContador = 0;
								if (is_dir($ruta_)) {
									if ($dh_ = opendir($ruta_)) {
										while (($file = readdir($dh_)) !== false) {
											if (!is_dir($ruta_ . $file) && $file != "." && $file != "..") {
												$totalContador = $totalContador + 1;
											}
										}
										closedir($dh_);
									}
								}
								if ($totalContador) {
									$directoriosPresentes_[] = $file_;
								} else {
								}
							}
						}
						closedir($dh);
					}

					if ($directoriosPresentes_) {
						$b  = 	'<select class="form-control" onchange="selectcCampanaDirectorio(this.value)"  id="CampanaDirectorio" name="CampanaDirectorio" class="form-control">
					              			<option selected value="0">Seleccione...</option>';
						foreach ($directoriosPresentes_ as $kesy) {
							$b 	=	$b . '<option value="' . utf8_encode($kesy) . '">' . utf8_encode($kesy) . '</option>';
						}
						$b 	= 	$b . '</select>';

						//echo '<br>' . $b . '<br>' ;


						$json['CampanaDirectorio_'] =	$b;
						$json['resultRuta'] =	1;  // 1 es una ruta válida
						$json['ruta_'] = $ruta;
						echo json_encode($json);
					} else {
						$b  = 	'<select class="form-control" onchange="selectcCampanaDirectorio(this.value)" required id="CampanaDirectorio" name="CampanaDirectorio" class="form-control">
					              			<option selected value="0">Seleccione...</option>';
						foreach ($directoriosPresentes_ as $kesy) {
							$b 	=	$b . '<option value="' . utf8_encode($kesy) . '">' . utf8_encode($kesy) . '</option>';
						}
						$b 	= 	$b . '</select>';

						$json['CampanaDirectorio_'] =	$b;
						$json['resultRuta'] =	1;  // 1 es una ruta válida
						$json['ruta_'] = $ruta;
						echo json_encode($json);
					}
				} else {
					//echo "<br>No es ruta valida";
					$json['CampanaDirectorio_'] =	"";
					$json['resultRuta'] =	0;	//0 no es una ruta valida
					$json['ruta_'] = $ruta;
					echo json_encode($json);
				}

				/*if (is_dir($ruta)) {
				    if ($dh = opendir($ruta)) {
				      	//echo '<br> RUta: '.$ruta.'<br>';
				        while (($file = readdir($dh)) !== false) {
				            //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
				            //mostraría tanto archivos como directorios
				            //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);
				            if (is_dir($ruta . $file) && $file!="." && $file!=".."){
				               //solo si el archivo es un directorio, distinto que "." y ".."
				               //echo "<br>Directorio: $ruta$file";
				               //echo '<br> Archivo: '.$file.'<br>';	
				               $directoriosPresentes_[] = $file;
				               //listar_directorios_ruta($ruta . $file . "/");
				            }
				         }
				      closedir($dh);
				    }

				    	if ($directoriosPresentes_) {
				    		$b  = 	'<select class="form-control" onchange="selectcCampanaDirectorio(this.value)"  id="CampanaDirectorio" name="CampanaDirectorio" class="form-control">
					              			<option selected value="0">Seleccione...</option>';			                
					           			 foreach ($directoriosPresentes_ as $kesy){
							$b 	=	$b. '<option value="'.utf8_encode($kesy).'">'.utf8_encode($kesy).'</option>';
					            		}
							$b 	= 	$b. '</select>'; 
						
							//echo '<br>' . $b . '<br>' ;
							

							$json['CampanaDirectorio_']=	$b;	
							$json['resultRuta']=	1;  // 1 es una ruta válida
							$json['ruta_'] = $ruta;
							echo json_encode($json);

				    	}else{
				    		$b  = 	'<select class="form-control" onchange="selectcCampanaDirectorio(this.value)" required id="CampanaDirectorio" name="CampanaDirectorio" class="form-control">
					              			<option selected value="0">Seleccione...</option>';			                
					           			 foreach ($directoriosPresentes_ as $kesy){
							$b 	=	$b. '<option value="'.utf8_encode($kesy).'">'.utf8_encode($kesy).'</option>';
					            		}
							$b 	= 	$b. '</select>'; 

							$json['CampanaDirectorio_']=	$b;	
							$json['resultRuta']=	1;  // 1 es una ruta válida
							$json['ruta_'] = $ruta;
							echo json_encode($json);
				    	}
				}else{
				    //echo "<br>No es ruta valida";
				    $json['CampanaDirectorio_']=	"";
				    $json['resultRuta']=	0;	//0 no es una ruta valida
				    $json['ruta_'] = $ruta;
				    echo json_encode($json);
				}*/

				break;
				#---------------------------------------------------------------
				#---------------------------------------------------------------
			default:
				header('location:' . HTML_DIR . 'error.html');
				break;
		}
	}
}
