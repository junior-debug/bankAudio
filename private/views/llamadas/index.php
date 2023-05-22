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

    function validateDate() {
        /*if(document.getElementById("date").value == ""){
            alert("Debe seleccionar una fecha para continuar.");
            return false;

        }else{*/
        //alert('aquuiii')
        cedula_input = $('#inputCedula_filtro').val();
        telefono_input = $('#inputTelefono_filtro').val();
        hora_input = $('#inputHora_filtro').val();
        segundos_input = $('#inputHoraSeg_filtro').val();


        $('#inputCedula_filtroForm').val(cedula_input);
        $('#inputTelefono_filtroForm').val(telefono_input);
        $('#inputHora_filtroForm').val(hora_input);
        $('#inputHoraSeg_filtroForm').val(segundos_input);
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


            } else if (e == 'bancaasistencia' || e == 'fastpayment' || e == 'simpletv' || e == 'movilnet') {
                $('#directorioDos').removeAttr('disabled', 'disabled');
                $.ajax({
                    type: 'POST',
                    url: '?view=llamadas&mode=ServiceDos',
                    dataType: "json",
                    data: {
                        servicioUno: $('#servicio_index').val()
                    },
                    success: function(datos) {
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
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-phone icon-gradient bg-premium-dark"></i>
                    </div>
                    <div>
                        Grabaciones
                    </div>
                </div>
            </div>
        </div>

        <?php /*if($_SESSION['cod_serv'] == 1){$directorio = "llamadas/hbl/";}else{$directorio = "../../../../audiobank-vicidial/simpletv/simpletv-atc/";}*/ ?>

        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Seleccione la fecha a consultar </h5>
                <div>

                    <form name="form1" id="form1" method="POST" action="?view=llamadas&mode=result" class="form-inline">
                        <div class="mb-2 mr-sm-3 mb-sm-0 position-relative form-group">
                            <label for="exampleEmail22" class="mr-sm-2">Servicio</label>
                            <select class="form-control" id="servicio_index" name="servicio_index" required onchange="servicioSelectUno(this.value);">
                                <option value="0" selected>Seleccione...</option>
                                <?php foreach ($directorioUno as $listUno) {
                                    print_r($_SESSION['name_cod_serv']);
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

                        <div class="mb-2 mr-sm-3 mb-sm-0 position-relative form-group">
                            <label for="exampleEmail22" class="mr-sm-2" id="label_campanasDirectorioDos_" style="display:none;">Campaña</label>
                            <div id="bloqueServiceDos"></div>
                        </div>

                        <div class="mb-2 mr-sm-3 mb-sm-0 position-relative form-group" style="display:none;" id="bloqueFecha">
                            <label for="exampleEmail22" class="mr-sm-2" id="label_fecha">Fecha</label>
                            <?php if ($_SESSION["type_user"] == '6') { ?>
                                <input disabled onchange="selectDate(this.value)" class="form-control date-picker" id="date" name="date">
                            <?php } else { ?>
                                <input disabled onchange="selectDate(this.value)" type="date" class="form-control" id="date" name="date" max="<?= date('Y-m-d'); ?>">
                            <?php }; ?>
                        </div>
                        <div class="mb-2 mr-sm-3 mb-sm-0 position-relative form-group">
                            <label for="exampleEmail22" class="mr-sm-2" id="label_campana_Vicidial" style="display:none;">Campaña_Vicidial</label>
                            <div id="bloqueCampanasIndex"></div>
                        </div>
                        <input hidden type="text" class="form-control" id="inputCedula_filtroForm" name="inputCedula_filtroForm">
                        <input hidden type="text" class="form-control" id="inputTelefono_filtroForm" name="inputTelefono_filtroForm">
                        <input hidden type="text" class="form-control" id="inputHora_filtroForm" name="inputHora_filtroForm">
                        <input hidden type="text" class="form-control" id="inputHoraSeg_filtroForm" name="inputHoraSeg_filtroForm">
                    </form><br>

                    <div class="form-inline">
                        <div class="mb-2 mr-sm-3 mb-sm-0 position-relative form-group">
                            <label for=" " class="mr-sm-2">Cédula</label>
                            <input type="number" class="form-control" id="inputCedula_filtro" name="inputCedula_filtro_"> <!-- placeholder="18005963"-->
                        </div>
                        <div class="mb-2 mr-sm-3 mb-sm-0 position-relative form-group">
                            <label for=" " class="mr-sm-2">Télefono</label>
                            <input type="number" class="form-control" id="inputTelefono_filtro" name="inputTelefono_filtro_"> <!-- placeholder="04144851233"-->
                        </div>
                        <div class="mb-2 mr-sm-3 mb-sm-0 position-relative form-group">
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

                        <div class="mb-2 mr-sm-3 mb-sm-0 position-relative form-group">
                            <button class="btn btn-primary" id="btn-buscar" onclick="return validateDate()">Buscar</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="scroll-area-md">
                    <div class="scrollbar-container">
                        <h5 class="card-title">Grabaciones de la fecha <strong class="text-info"><?= $_POST['date']; ?></strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Total registro: <strong class="text-info"> <?php if ($abc == 88 || $abc == 100) {
                                                                                                                                                                                                                    echo count($resultados_consult);
                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                    echo $countResult;
                                                                                                                                                                                                                } ?></strong></h5>
                        <h5 class="card-title">Ruta <strong class="text-info"><?= $directorio; ?></strong></h5>
                        <h5 class="card-title">Filtros <strong class="text-info"> <?php if ($abc == 88  || $abc == 100) {
                                                                                        echo 'cedula: ' . $cedula_filtro . ' / ' . 'teléfono: ' . $telefono_filtro . ' / ' . 'Hora: ' . $horaGeneral;
                                                                                    } ?> </strong></h5> <br>

                        <div id="result">
                            <?php //echo '<br> aquiiiii '.$abc.'<br>';
                            /*    echo ' <br>  servicio_index: '. $_POST['servicio_index'].' <br> ';
                                            echo ' <br>  CampanaDirectorio: '. $_POST['CampanaDirectorio'].' <br> ';

                                        echo ' <br> date:  '. $date.' <br> ';
                                        echo "../../../../audiobank-vicidial/simpletv/simpletv-atc".' <br><br> ';
                                        echo ' <br> directorio:  '.$directorio.' <br><br> ';
                                        echo  '/audiobank-vicidial/simpletv/simpletv-atc/2022/04/06/STVIVR';
                                        echo $abc.'<br><br>';*/

                            if ($abc == 88) {
                                if ($resultados_consult) {
                                    foreach ($resultados_consult as $key) {
                                        echo '<div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group"><div class="form-inline"><ol><a href="' . $directorio . $key . '" class="mr-2 btn btn-primary form-group" target="_blank">' . $key . '</a></ol></div></div>';
                                    }
                                } else {
                                    echo '<h5 align="center" class="card-subtitle">Esta fecha no posee grabaciones registradas</h5>';
                                }
                            } else if ($abc == 100) {
                                if ($resultados_consult) {
                                    foreach ($resultados_consult as $key) {
                                        echo '<div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group"><div class="form-inline"><ol><a href="' . $key . '" class="mr-2 btn btn-primary form-group" target="_blank">' . $key . '</a></ol></div></div>';
                                    }
                                }
                            } else if ($abc == 99) {

                                if ($handle = opendir($resultados_consult)) {
                                    while ($entry = readdir($handle)) {
                                        //echo $entry.'<br>';

                                        if ($entry === "." || $entry === "..") {
                                        } else {
                                            echo '<div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group"><div class="form-inline"><ol><a href="' . $resultados_consult . $entry . '" class="mr-2 btn btn-primary form-group" target="_blank">' . $entry . '</a></ol></div></div>';
                                        }
                                    }
                                } else {
                                    echo '<h5 align="center" class="card-subtitle">Esta fecha no posee grabaciones registradas</h5>';
                                }
                                closedir($handle);
                            } else {
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
</style>

<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>