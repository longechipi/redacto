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
                <form class="tab-wizard wizard-circle wizard" id="example-form">
                    <h5>Datos del Vendedor</h5>
                    <section>
                        <div class="text-center">
                            <div class="alert alert-primary" role="alert">
                            <i class="icon-copy dw dw-idea"></i>&nbsp;Recuerde revisar que los datos que esten escritos correctamente 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tipo de Persona </label> <span class="text-danger">(*)</span>
                                    <select name="tip_per" id="tip_per" class="form-control required" required>
                                        <option value="" selected disabled>SELECCIONAR</option>
                                        <option value="N">Natural</option>
                                        <option value="J">Jurídico</option>
                                        <option value="S">Sucesión</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Primer Nombre </label> <span class="text-danger">(*)</span>
                                    <input type="text" class="form-control" name="nombre1" onkeypress="return letras(this, event);" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Segundo Nombre </label>
                                    <input type="text" class="form-control" name="nombre2" onkeypress="return letras(this, event);" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Primer Apellido </label> <span class="text-danger">(*)</span>
                                    <input type="text" class="form-control" name="apellido1" onkeypress="return letras(this, event);" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Segundo Apellido </label> <span class="text-danger">(*)</span>
                                    <input type="text" class="form-control" name="apellido2" onkeypress="return letras(this, event);" >
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nacionalidad</label> <span class="text-danger">(*)</span>
                                    <select name="nac" id="nac" class="form-control" required>
                                        <option value="" selected disabled>SELECCIONAR</option>
                                        <option value="V">Venezolano</option>
                                        <option value="E">Extranjero</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nro de Cédula</label> <span class="text-danger">(*)</span>
                                    <input type="text" class="form-control" name="cedula" onkeypress="return numeros(this, event);" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Estado Civil</label> <span class="text-danger">(*)</span>
                                    <select name="edo_civil" id="edo_civil" class="form-control" required>
                                        <option value="" selected disabled>SELECCIONAR</option>
                                        <option value="S">Soltero</option>
                                        <option value="C">Casado</option>
                                        <option value="V">Viudo</option>
                                        <option value="V">Divorciado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="casado" hidden>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nombre Cónyuge</label>
                                    <input type="text" class="form-control" name="nom_conyuge" id="nom_conyuge" onkeypress="return letras(this, event);" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Apellido Cónyuge</label>
                                    <input type="text" class="form-control" name="ape_conyuge" id="ape_conyuge" onkeypress="return letras(this, event);" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cédula Cónyuge</label>
                                    <input type="text" class="form-control" name="ced_conyuge" id="ced_conyuge" onkeypress="return numeros(this, event);" required>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 2 -->
                    <h5>Datos del Comprador</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Job Title :</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Company Name :</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Job Description :</label>
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 3 -->
                    <h5>Datos del Vehículo</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Interview For :</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Interview Type :</label>
                                    <select class="form-control">
                                        <option>Normal</option>
                                        <option>Difficult</option>
                                        <option>Hard</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Interview Date :</label>
                                    <input type="text" class="form-control date-picker" placeholder="Select Date">
                                </div>
                                <div class="form-group">
                                    <label>Interview Time :</label>
                                    <input class="form-control time-picker" placeholder="Select time" type="text">
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>
        <?php include('../layouts/footer.php');?>
        <script src="../src/plugins/jquery-steps/jquery.steps.js"></script>
        <script>
            $("#example-form").steps({
                headerTag: "h5",
                bodyTag: "section",
                transitionEffect: "fade",
                titleTemplate: '<span class="step">#index#</span> #title#',
                labels: {
                    finish: "Submit"
                },
                onStepChanged: function (event, currentIndex, priorIndex) {
                    $('.steps .current').prevAll().addClass('disabled');
                },
                onFinishing: function (event, currentIndex){
                    alert("finishing");
                },
                onStepChanging: function (event, currentIndex, newIndex){
                    if(currentIndex == 0){
                        if($('#tip_per').val() == null){
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
        </script>


</body>
</html>