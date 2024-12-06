<?php 
include('../layouts/header.php');
require('../conf/conex.php');
require('../utils/utils.php');
session_start();
?>
<body>
<?php include('../layouts/navbar.php');?>
<?php include('../layouts/options.php');?>
<?php include('../layouts/menu.php'); ?>
	<div class="mobile-menu-overlay"></div>
	<div class="main-container">
		<div class="pd-ltr-20">
            <div class="title">
                <h5>Generar Nuevo Documento</h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo Documento</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <div class="wizard-content">
                <form class="tab-wizard wizard-circle wizard" id="form-doc">
                    <input type="text" name="id_user" id="id_user" class="form-control" value="<?php echo $id_user; ?>" hidden readonly/>
                    <h5>Datos del Vendedor</h5>
                    <?php include('reg_doc/vendedor.php'); ?>
                    <!-- Step 2 -->
                    <h5>Datos del Comprador</h5>
                    <?php include('reg_doc/comprador.php'); ?>
                    <!-- Step 3 -->
                    <h5>Datos del Vehículo</h5>
                    <?php include('reg_doc/vehiculo.php'); ?>
                    <!-- Step 4 -->
                    <h5>Importe de la Venta</h5>
                    <?php include('reg_doc/importe_venta.php'); ?>
                </form>
            </div>
        </div>
        <?php include('../layouts/footer.php');?>
        <script src="../src/plugins/jquery-steps/jquery.steps.js"></script>
        <script>
            $("#form-doc").steps({
                headerTag: "h5",
                bodyTag: "section",
                transitionEffect: "fade",
                titleTemplate: '<span class="step">#index#</span> #title#',
                labels: {
                    finish: "Guardar"
                },
                onStepChanged: function (event, currentIndex, priorIndex) {
                    $('.steps .current').prevAll().addClass('disabled');
                },
                onFinishing: function (event, currentIndex){
                    if(($('#ciudad').val() == '') || ($('#estado').val() == '') || ($('#divisa').val() == '') || ($('#tasa').val() == '') || ($('#bs').val() == '')){
                        swal({
                            title: 'Error',
                            text: 'Complete los Campos Requeridos',
                            type: 'error',
                            confirmButtonColor: '#1b61c2',
                            confirmButtonText: 'Aceptar'
                        })
                        return false;
                    }
                    if ($('#customCheck1').is(':checked')) {
                        $.ajax({
                            url: '../model/documento/new_doc.php',
                            type: 'POST',
                            data: $('#form-doc').serialize(),
                            success: function(data){
                                const res = JSON.parse(data);
                                if(res.success == false){
                                    swal({
                                        title: 'Error al Registrar',
                                        text: res.error.message,
                                        type: 'error',
                                        confirmButtonColor: '#1b61c2',
                                        confirmButtonText: 'Aceptar'
                                    })
                                    return
                                    //document.getElementById('form-doc').reset();
                                 }
                                 if(res.success == true){
                                    swal({
                                        title: 'Registro Exitoso',
                                        text: res.message,
                                        type: 'success',
                                        confirmButtonColor: '#1b61c2',
                                        confirmButtonText: 'Aceptar'
                                    }).then(function() {
                                        window.location.href = 'documentos';
                                    });
                                }
                            }
                        });
                    }else {
                        event.preventDefault();
                        swal({
                            title: 'Error',
                            text: 'Por favor, acepte los Términos y Condiciones',
                            type: 'error',
                            confirmButtonColor: '#1b61c2',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                },
                onStepChanging: function (event, currentIndex, newIndex){
                    //--------- Validacion para el Primer Step Vendedor ------------//
                    if(currentIndex == 0){ 
                        //----- Validacion para Natural ------//
                        if($('#tip_per').val() == 'N'){
                            if(($('#tip_per').val() == '') || ($('#nombre1').val() == '') || ($('#apellido1').val() == '') || ($('#nac').val() == '') || ($('#cedula').val() == '') || ($('#edo_civil').val() == '')){
                                swal({
                                    title: 'Error',
                                    text: 'Complete los Campos Requeridos',
                                    type: 'error',
                                    confirmButtonColor: '#1b61c2',
                                    confirmButtonText: 'Aceptar'
                                })
                                return false;
                            }else{
                                if($('#edo_civil').val() == 'C'){
                                    if(($('#nom_conyuge').val() == '') || ($('#ape_conyuge').val() == '') || ($('#ced_conyuge').val() == '')){
                                        swal({
                                            title: 'Error',
                                            text: 'Complete los Campos Requeridos',
                                            type: 'error',
                                            confirmButtonColor: '#1b61c2',
                                            confirmButtonText: 'Aceptar'
                                        })
                                        return false;
                                    }
                                }
                            }
                        }
                        //----- Validacion para Juridico ------//
                        if($('#tip_per').val() == 'J'){
                            if(($('#tip_per').val() == '') || ($('#nom_emp').val() == '') || ($('#rif').val() == '') || ($('#fec_reg').val() == '') || ($('#nom_reg').val() == '') || ($('#tomo').val() == '') || ($('#nro').val() == '') || ($('#protocolo').val() == '') || ($('#exp').val() == '')){
                                swal({
                                    title: 'Error',
                                    text: 'Complete los Campos Requeridos',
                                    type: 'error',
                                    confirmButtonColor: '#1b61c2',
                                    confirmButtonText: 'Aceptar'
                                })
                                return false;
                            }
                            
                        }
                        //----- Validacion para Sucesion ------//
                        if($('#tip_per').val() == 'S'){
                            if(($('#tip_per').val() == '') || ($('#nom_suc').val() == '') || ($('#rif_su').val() == '') || ($('#cer_sol').val() == '')){
                                swal({
                                    title: 'Error',
                                    text: 'Complete los Campos Requeridos',
                                    type: 'error',
                                    confirmButtonColor: '#1b61c2',
                                    confirmButtonText: 'Aceptar'
                                })
                                return false;
                            }
                            
                        }
                    } 
                    //--------- Validacion para el Segundo Step Comprador ----------//
                    if(currentIndex == 1){ 
                        //----- Validacion para Natural ------//
                        if($('#com_tip_per').val() == 'N'){
                            if(($('#com_tip_per').val() == '') || ($('#com_nombre1').val() == '') || ($('#com_apellido1').val() == '') || ($('#com_nac').val() == '') || ($('#com_cedula').val() == '') || ($('#com_edo_civil').val() == '')){
                                swal({
                                    title: 'Error',
                                    text: 'Complete los Campos Requeridos',
                                    type: 'error',
                                    confirmButtonColor: '#1b61c2',
                                    confirmButtonText: 'Aceptar'
                                })
                                return false;
                            }
                        }
                        //----- Validacion para Juridico ------//
                        if($('#com_tip_per').val() == 'J'){
                            if(($('#com_tip_per').val() == '') || ($('#com_nom_emp').val() == '') || ($('#com_rif').val() == '') || ($('#com_fec_reg').val() == '') || ($('#com_nom_reg').val() == '') || ($('#com_tomo').val() == '') || ($('#com_nro').val() == '') || ($('#com_protocolo').val() == '') || ($('#com_exp').val() == '')){
                                swal({
                                    title: 'Error',
                                    text: 'Complete los Campos Requeridos',
                                    type: 'error',
                                    confirmButtonColor: '#1b61c2',
                                    confirmButtonText: 'Aceptar'
                                })
                                return false;
                            }
                            
                        }
                        //----- Validacion para Sucesion ------//
                        if($('#com_tip_per').val() == 'S'){
                            if(($('#com_tip_per').val() == '') || ($('#com_nom_suc').val() == '') || ($('#com_rif_su').val() == '') || ($('#com_cer_sol').val() == '')){
                                swal({
                                    title: 'Error',
                                    text: 'Complete los Campos Requeridos',
                                    type: 'error',
                                    confirmButtonColor: '#1b61c2',
                                    confirmButtonText: 'Aceptar'
                                })
                                return false;
                            }
                            
                        }
                    }
                    //--------- Validacion para el Tercer Step ----------//
                    if(currentIndex == 2){
                        if(($('#reg_veh').val() == '') || ($('#fec_cert').val() == '') || ($('#clase').val() == '') || ($('#modelo').val() == '') || ($('#ano_veh').val() == '') || ($('#tipo').val() == '') || ($('#color').val() == '') || ($('#placa').val() == '') || ($('#marca').val() == '') || ($('#uso').val() == '') || ($('#serial_carro').val() == '')){
                            swal({
                                title: 'Error',
                                text: 'Complete los Campos Requeridos',
                                type: 'error',
                                confirmButtonColor: '#1b61c2',
                                confirmButtonText: 'Aceptar'
                            })
                            return false;
                        }
                    }
                    return true;
                },
            });
            //-------- CONDICIONAL PARA VENDEDOR ----------//
            $('#tip_per').change(function(){
                //----- Habilito Formulario de Persona Natural ------//
                if($('#tip_per').val() == 'N'){
                    $('#natural').removeAttr('hidden');
                    $('#juridico').attr('hidden', true);
                    $('#sucesion').attr('hidden', true);

                    //------- CONDICIONAL PARA CONYUGE --------//
                    $('#edo_civil').change(function(){
                        if($('#edo_civil').val() == 'C'){
                            $('#casado').removeAttr('hidden');
                            $('#nom_conyuge').attr('required', true);
                            $('#ape_conyuge').attr('required', true);
                            $('#ced_conyuge').attr('required', true);
                        }else{
                            $('#casado').attr('hidden', true);
                            $('#nom_conyuge').removeAttr('required');
                            $('#ape_conyuge').removeAttr('required');
                            $('#ced_conyuge').removeAttr('required');
                        }
                    });

                }
                //----- Habilito Formulario de Persona Juridica ------//
                if($('#tip_per').val() == 'J'){
                    $('#juridico').removeAttr('hidden');
                    $('#natural').attr('hidden', true);
                    $('#sucesion').attr('hidden', true);

                    //---- Validacion para la Fecha ----//
                    $('#fec_reg').on('blur', function() {
                        validarFecha(this);
                    })
                }
                //----- Habilito Formulario de Sucesion ------//
                if($('#tip_per').val() == 'S'){
                    $('#sucesion').removeAttr('hidden');
                    $('#natural').attr('hidden', true);
                    $('#juridico').attr('hidden', true);
                }
            })
            //-------- CONDICIONAL PARA COMPRADOR ----------//
            $('#com_tip_per').change(function(){
                //----- Habilito Formulario de Comprador Natural ------//
                if($('#com_tip_per').val() == 'N'){
                    $('#com_natural').removeAttr('hidden');
                    $('#com_juridico').attr('hidden', true);
                    $('#com_sucesion').attr('hidden', true);
                }
                //----- Habilito Formulario de Comprador Juridica ------//
                if($('#com_tip_per').val() == 'J'){
                    $('#com_juridico').removeAttr('hidden');
                    $('#com_natural').attr('hidden', true);
                    $('#com_sucesion').attr('hidden', true);

                    //---- Validacion para la Fecha ----//
                    $('#com_fec_reg').on('blur', function() {
                        validarFecha(this);
                    })
                }
                //----- Habilito Formulario Comprador de Sucesion ------//
                if($('#com_tip_per').val() == 'S'){
                    $('#com_sucesion').removeAttr('hidden');
                    $('#com_natural').attr('hidden', true);
                    $('#com_juridico').attr('hidden', true);
                }
            })
            //-------- CONDICIONAL PARA VEHICULO ----------//
            $('#clase').change(function(){
                if($('#clase').val() == 'VEHICULO'){
                    $('#ano_veh').on('blur', function() {
                        if($('#ano_veh').val() <= 2000){
                           $('#ser_motor_menor').removeAttr('hidden');
                           $('#ser_motor_mayor').attr('hidden', true);
                        }else{
                            $('#ser_motor_mayor').removeAttr('hidden');
                            $('#ser_motor_menor').attr('hidden', true);
                        }
                    })
                }
            })
            $('#uso').change(function(){
                if($('#uso').val() == 'OTRO'){
                    $('#otrouso').removeAttr('hidden');
                    $('#otrouso').attr('required', true);
                }else{
                    $('#otrouso').attr('hidden', true);
                    $('#otrouso').removeAttr('required');
                }

            })
            //---- Validacion para la Fecha ----//
            $('#fec_cert').on('blur', function() {
                validarFecha(this);
            })
            //-------- CALCULO PARA DOLARES ----------//
            function calculateBolivares() {
                var divisa = parseFloat($('#divisa').val());
                var tasa = parseFloat($('#tasa').val());
                    if (!isNaN(divisa) && !isNaN(tasa)) {
                        var bs = divisa * tasa;
                        $('#bs').val(bs.toFixed(2));
                    }else {
                        $('#bs').val('');
                    }
            }
            $('#divisa, #tasa').on('input', calculateBolivares);
            calculateBolivares();
        </script>
</body>
</html>