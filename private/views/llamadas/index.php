<script type="text/javascript">
    const currentTime = new Date()
    const minDate = new Date(currentTime.getFullYear(), currentTime.getMonth(), +1); //one day next before month
    const maxDate = new Date(currentTime.getFullYear(), currentTime.getMonth(), currentTime.getDate()); // one day before next month

    $(function() {
        $('.date-picker').datepicker({
            changeMonth: false,
            changeYear: false,
            showButtonPanel: false,
            dateFormat: "yy-mm-dd",
            minDate: minDate,
            maxDate: maxDate,
            onClose: function(dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
        });
    });

    function showAudio(ruta){
        let ruta_audio = document.getElementById(ruta);
        let contenedores = document.getElementsByClassName('audio_container');

        // Eliminar todos los audios abiertos previamente
        for(let i = 0; i < contenedores.length; i++) {
            contenedores[i].innerHTML = "";
        }

        // Abrir el nuevo audio
        ruta_audio.innerHTML = "<audio src=" + ruta + " controls autoplay loop id='showAudio'></audio>";
    }

    function validateDate() {
        /*if(document.getElementById("date").value == ""){
            alert("Debe seleccionar una fecha para continuar.");
            return false;
        }else{*/

        cedula_input = $('#inputCedula_filtro').val();
        telefono_input = $('#inputTelefono_filtro').val();
        hora_input = $('#inputHora_filtro').val();
        segundos_input = $('#inputHoraSeg_filtro').val();
        durationAudio = $('#inputTiempo_filtro').val();
        date = $('#date').val();
        campana = $('#CampanaDirectorio').val();

        if (cedula_input && date && campana == '0') {
            alert('selecciones campaña')
        }

        if (telefono_input && date && campana == '0') {
            alert('selecciones campaña')
        }

        if (telefono_input && cedula_input && date && campana == '0') {
            alert('selecciones campaña')
        }

        $('#inputCedula_filtroForm').val(cedula_input);
        $('#inputTelefono_filtroForm').val(telefono_input);
        $('#inputHora_filtroForm').val(hora_input);
        $('#inputHoraSeg_filtroForm').val(segundos_input);
        $('#inputTiempo_filtroForm').val(durationAudio);
        //alert( cedula_input  + ' --> '+ telefono_input  + ' --> '+  hora_input+ ' --> '+  segundos_input)
        //alert( $('#inputCedula_filtroForm').val()  + ' --> '+ $('#inputTelefono_filtroForm').val()  + ' --> '+  $('#inputHora_filtroForm').val() + ' --> '+  $('#inputHoraSeg_filtroForm').val() )

        document.getElementById('form1').submit();
        return false;
        //}
    }

    function servicioSelectUno(e) {
        //alert(e) 
        if (e == 0) {
            alert('Debe seleccionar un servicio');
            //$('#btn-buscar').attr('disabled','disabled'); 

            $('#label_campanasDirectorioDos_').hide();
            $('#directorioDos').hide();
            $('#bloqueFecha').hide();
            $('#label_campana_Vicidial').hide();
            $('#CampanaDirectorio').hide();
            $('#date').val("");
            $('#directorioDos').empty();
            $('#CampanaDirectorio').empty();
            $('#directorioDos').attr('disabled', 'disabled');
            $('#date').attr('disabled', 'disabled');
            $('#CampanaDirectorio').attr('disabled', 'disabled');

        } else {
            if (e == 'cocacola' || e == 'lagiralda' || e == 'herbalife') {
                $('#date').val("");
                $('#bloqueFecha').show();
                $('#date').removeAttr('disabled', 'disabled');


            } else if (e == 'bancaasistencia' || e == 'fastpayment' || e == 'simpletv' || e == 'movilnet' || e == 'cegesa' ) {
                console.log(e)
                $('#directorioDos').removeAttr('disabled', 'disabled');
                $.ajax({
                    type: 'POST',
                    url: '?view=llamadas&mode=ServiceDos',
                    dataType: "json",
                    data: {
                        servicioUno: $('#servicio_index').val()
                    },
                    success: function(datos) {
                        console.log(datos)
                        //alert(datos.selectServicioDosDirectorio) 
                        if (datos.resultRuta == 1) {
                            $('#directorioDos').removeAttr('disabled', 'disabled');
                            $('#label_campanasDirectorioDos_').show();
                            $('#bloqueServiceDos').html(datos.selectServicioDosDirectorio)
                        } else {
                            alert(' No es una ruta válida');
                            $('#date').attr('disabled', 'disabled');
                            $('#CampanaDirectorio').attr('disabled', 'disabled');
                            //$('#btn-buscar').attr('disabled','disabled');
                        }
                    }
                });
            }
        }
    }

    function servicioSelectDos(e) {
        //alert(e)
        if (e == 0) {
            alert('Debe seleccionar un servicio');
            $('#bloqueFecha').hide();
            $('#label_campana_Vicidial').hide();
            $('#CampanaDirectorio').hide();
            //$('#btn-buscar').attr('disabled','disabled'); 
            $('#date').attr('disabled', 'disabled');
            $('#CampanaDirectorio').attr('disabled', 'disabled');
            $('#CampanaDirectorio').empty();

        } else {
            $('#date').val("");
            $('#bloqueFecha').show();
            $('#date').removeAttr('disabled', 'disabled');
        }
    }

    function selectDate(e) {
        //alert(e)
        // alert( 'servicio: ' + $('#servicio_index').val() + 'servicio2: '+ $('#directorioDos').val() + 'fecha:'+ e )
        if (e == 0) {
            alert('Debe seleccionar una fecha');
            //$('#btn-buscar').attr('disabled','disabled'); 
            $('#label_campana_Vicidial').hide();
            $('#CampanaDirectorio').hide();
            $('#CampanaDirectorio').empty();
            $('#CampanaDirectorio').attr('disabled', 'disabled');
        } else {
            $.ajax({
                type: 'POST',
                url: '?view=llamadas&mode=campanasSelect',
                dataType: "json",
                data: {
                    servicio: $('#servicio_index').val(),
                    servicio2: $('#directorioDos').val(),
                    fecha: e
                },
                success: function(datos) {
                    // alert(datos.CampanaDirectorio_) 
                    if (datos.resultRuta == 1) {
                        $('#label_campana_Vicidial').show();
                        $('#CampanaDirectorio').removeAttr('disabled', 'disabled');
                        $('#bloqueCampanasIndex').html(datos.CampanaDirectorio_)
                    } else {
                        alert(' No es una ruta válida');
                        $('#CampanaDirectorio').attr('disabled', 'disabled');
                        //$('#btn-buscar').attr('disabled','disabled');
                    }
                }
            });
        }
    }

    function selectcCampanaDirectorio(e) {
        //alert(e)
        if (e == 0) {
            alert('Debe seleccionar una campaña');
            //$('#btn-buscar').attr('disabled','disabled'); 
            $('#bloqueCedula').hide();

        } else {
            $('#bloqueCedula').show();
            //$('#btn-buscar').removeAttr('disabled','disabled'); 
        }
    }
</script>

<?php  
    include(__DIR__ . '/../../../src/Mp3Info.php');
    use wapmorgan\Mp3Info\Mp3Info;
?>

<!-- Body -->
<div class="app-main__outer">
    <div class="app-main__inner">
        <!-- Header -->
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-phone icon-gradient bg-premium-dark"></i>
                    </div>
                    <div>Grabaciones</div>
                </div>
            </div>
        </div>

        <?php /*if($_SESSION['cod_serv'] == 1){$directorio = "llamadas/hbl/";}else{$directorio = "../../../../audiobank-vicidial/simpletv/simpletv-atc/";}*/ ?>

        <!-- Formulario -->
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Seleccione la fecha a consultar</h5>
                <div>
                    <!-- Mitad 1 -->
                    <form name="form1" id="form1" method="POST" action="?view=llamadas&mode=result" class="form-inline">
                        <div class="mb-2 mr-sm-3 mb-sm-0 position-relative form-group">
                            <label for="exampleEmail22" class="mr-sm-2">Servicio</label>
                            <select class="form-control" id="servicio_index" name="servicio_index" required onchange="servicioSelectUno(this.value);">
                                <option value="0" selected>Seleccione...</option>
                                <?php foreach ($directorioUno as $listUno) {
                                    if ($listUno != 'lost+found') {
                                        if ($listUno == strtolower($_SESSION['name_cod_serv'])) {
                                            echo '<option value="' . $listUno . '">' . $listUno . '</option>';
                                        }

                                        if ($_SESSION['name_cod_serv'] == 'ADMIN') {
                                            echo '<option value="' . $listUno . '">' . $listUno . '</option>';
                                        }
                                    }
                                } ?>
                            </select>
                        </div>

                        <!-- Campaña -->
                        <div class="mb-2 mr-sm-3 mb-sm-0 position-relative form-group">
                            <label for="exampleEmail22" class="mr-sm-2" id="label_campanasDirectorioDos_" style="display:none;">Campaña</label>
                            <div id="bloqueServiceDos"></div>
                        </div>

                        <!-- Fecha -->
                        <div class="mb-2 mr-sm-3 mb-sm-0 position-relative form-group" style="display:none;" id="bloqueFecha">
                            <label for="exampleEmail22" class="mr-sm-2" id="label_fecha">Fecha</label>
                            <?php if ($_SESSION["type_user"] == '6') { ?>
                                <input disabled onchange="selectDate(this.value)" type="date" class="form-control" id="date" name="date">
                            <?php } else { ?>
                                <input disabled onchange="selectDate(this.value)" type="date" class="form-control" id="date" name="date" max="<?= date('Y-m-d'); ?>">
                            <?php }; ?>
                        </div>

                        <!-- Campaña_Vicidial -->
                        <div class="mb-2 mr-sm-3 mb-sm-0 position-relative form-group">
                            <label for="exampleEmail22" class="mr-sm-2" id="label_campana_Vicidial" style="display:none;">Campaña_Vicidial</label>
                            <div id="bloqueCampanasIndex"></div>
                        </div>

                        <!-- Cédula -->
                        <input 
                            hidden 
                            type="text" 
                            class="form-control" 
                            id="inputCedula_filtroForm" 
                            name="inputCedula_filtroForm"
                        >
                        <!-- Telefono -->
                        <input 
                            hidden 
                            type="text" 
                            class="form-control" 
                            id="inputTelefono_filtroForm" 
                            name="inputTelefono_filtroForm"
                        >
                        <!-- Hora -->
                        <input 
                            hidden 
                            type="text" 
                            class="form-control" 
                            id="inputHora_filtroForm" 
                            name="inputHora_filtroForm"
                        >
                        <!-- Segundos -->
                        <input 
                            hidden 
                            type="text" 
                            class="form-control" 
                            id="inputHoraSeg_filtroForm" 
                            name="inputHoraSeg_filtroForm"
                        >
                        <!-- Tiempo -->
                        <input 
                            hidden 
                            type="text" 
                            class="form-control" 
                            id="inputTiempo_filtroForm" 
                            name="inputTiempo_filtroForm"
                        >
                    </form>
                    <!-- Divider -->
                    <br>
                    <!-- Mitad 2 -->
                    <div class="form-inline">
                        <!-- Cédula -->
                        <div class="mt-3 mb-2 mr-sm-3 mb-sm-0 position-relative form-group">
                            <label for=" " class="mr-sm-2">Cédula</label>
                            <input type="number" class="form-control" id="inputCedula_filtro" name="inputCedula_filtro_"> <!-- placeholder="18005963"-->
                        </div>
                        <!-- Télefono -->
                        <div class="mt-3 mb-2 mr-sm-3 mb-sm-0 position-relative form-group">
                            <label for=" " class="mr-sm-2">Télefono</label>
                            <input type="number" class="form-control" id="inputTelefono_filtro" name="inputTelefono_filtro_"> <!-- placeholder="04144851233"-->
                        </div>
                        <!-- Hora / Segundos -->
                        <div class="mt-3 mb-2 mr-sm-3 mb-sm-0 position-relative form-group">
                            <label for=" " class="mr-sm-2">Hora</label>
                            <input type="time" class="form-control" id="inputHora_filtro" name="inputHora_filtro_"> <!-- placeholder="15:25:01"-->

                            <label style="margin-left: 5px;" for=" " class="mr-sm-2">Segundos</label>
                            <select class="form-control" id="inputHoraSeg_filtro" name="inputHoraSeg_filtro" required>
                                <option value="00" selected>Seleccione...</option>
                                <?php for ($i = 0; $i < 61; $i++) {
                                    if ($i < 10) {
                                        echo '<option value="0' . $i . '">0' . $i . '</option>';
                                    } else {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                } ?>
                            </select>
                        </div>
                        <!-- Duración audio -->
                        <div class="mt-3 mb-2 mr-sm-3 mb-sm-0 position-relative form-group">
                            <label for=" " class="mr-sm-2">tiempo duracion audio en segundos</label>
                            <input type="text" class="form-control" id="inputTiempo_filtro" name="inputTiempo_filtro"> <!-- placeholder="60"-->
                        </div>

                        <!-- Search button -->
                        <div class="mt-3 mb-2 mr-sm-3 mb-sm-0 position-relative form-group">
                            <button class="btn btn-primary" id="btn-buscar" onclick="return validateDate()">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resultado -->
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="scroll-area-md">
                    <div class="scrollbar-container">       
                        <!-- Fecha / Totales -->
                        <h5 class="card-title">
                            <span>Grabaciones de la fecha </span>
                            <strong class="text-info">
                                <?= $_POST['date']; ?>
                            </strong>
                            <span class="pl-5">Total registro:</span>
                            <strong class="text-info">
                                <?php echo ($abc == 88 || $abc == 100) ? count($resultados_consult) : $countResult; ?>
                            </strong>
                        </h5>

                        <!-- Ruta -->
                        <h5 class="card-title">
                            <span>Ruta</span>
                            <strong class="text-info">
                                <?= $directorio; ?>
                            </strong>
                        </h5>

                        <!-- Filtros -->
                        <h5 class="card-title">
                            Filtros 
                            <strong class="text-info"> 
                                <?php echo ($abc == 88 || $abc == 100) ? 'cedula: ' . $cedula_filtro . ' / telefono: ' . $telefono_filtro . ' / Hora: ' . $horaGeneral : ''; ?>
                            </strong>
                        </h5> 
                        
                        <br>
                        
                        <!-- Audios -->
                        <div id="result">
                            <?php
                                if ($abc == 88) {
                                    if ($resultados_consult) {
                                        foreach ($resultados_consult as $key) {
                                            $audioRuts = $directorio.$key;
                                            // Valida si el filtro está vacio o si es mayor al filtro.
                                            
                                            echo '<div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                                                <div class="form-inline">
                                                    <ol class="row text-left">
                                                        <div class="col">
                                                            <button class="mr-2 btn btn-primary form-group btn-fixed-width" onclick="showAudio(\'' . $audioRuts . '\')">' . $key . '</button>
                                                        </div>
                                                        <div class="col">
                                                            <div id="' . $audioRuts . '" class="audio_container"></div>
                                                        </div>
                                                    </ol>
                                                </div>
                                            </div>';                  
                                        }
                                    } else {
                                        echo '<h5 align="center" class="card-subtitle">Esta fecha no posee grabaciones registradas</h5>';
                                    }
                                } 
                                else if ($abc == 100) {
                                    if ($resultados_consult) {
                                        foreach ($resultados_consult as $key) {
 
                                            $lastSlashPos = strrpos($key, '/');
                                            if ($lastSlashPos !== false) {
                                                $lastSlashPos = substr($key, $lastSlashPos + 1);
                                            }
                                            echo '<div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                                                <div class="form-inline">   
                                                    <ol class="row text-left">
                                                        <div class="col">
                                                            <button class="mr-2 btn btn-primary form-group btn-fixed-width" onclick="showAudio(\'' . $key . '\')">' . $lastSlashPos . '</button>
                                                        </div>
                                                        <div class="col">
                                                            <div id="' . $key . '" class="audio_container"></div>
                                                        </div>
                                                    </ol>
                                                </div>
                                            </div>';
                                        }
                                    }
                                } 
                                else if ($abc == 99) {
                                    if ($handle = opendir($resultados_consult)) {
                                        while ($entry = readdir($handle)) {
                                            if ($entry === "." || $entry === "..") {
                                            } else {
                                                $audioRuts = $resultados_consult.$entry;
                                                echo '<div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                                                    <ol class="row text-left">
                                                        <div class="col">
                                                            <button class="mr-2 btn btn-primary form-group btn-fixed-width" onclick="showAudio(\'' . $audioRuts . '\')">' . $entry . '</button>
                                                        </div>
                                                        <div class="col">
                                                            <div id="' . $audioRuts . '" class="audio_container"></div>
                                                        </div>
                                                    </ol>
                                                </div>';
                                            }
                                        }
                                    } else {
                                        echo '<h5 align="center" class="card-subtitle">Esta fecha no posee grabaciones registradas</h5>';
                                    }
                                    closedir($handle);
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<style>
    #ui-datepicker-div {
        z-index: 8;
    }

    .btn-fixed-width {
    width: 380px!important; /* Ajusta este valor según sea necesario */
    white-space: nowrap!important;
    overflow: hidden!important;
    text-overflow: ellipsis!important;
    }

</style>
<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
