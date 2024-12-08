<?php 
include('../layouts/header.php');
require('../conf/conex.php');
require('../utils/utils.php');
session_start();
@$id_doc = $_POST['id_form'];
validar_post_char($id_doc, 'inicio');
?>
<body>
<?php include('../layouts/navbar.php');?>
<?php include('../layouts/options.php');?>
<?php include('../layouts/menu.php'); ?>
	<div class="mobile-menu-overlay"></div>
	<div class="main-container">
		<div class="pd-ltr-20">
            <div class="title">
                <h5>Datos del Documento: <?php echo $id_doc; ?></h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="documentos">Documentos Guardados</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pagar Documento</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <div class="text-center">
                <div class="alert alert-danger" role="alert">
                <i class="icon-copy dw dw-idea"></i> <br> <h5 class="mb-3">¡ATENCIÓN!</h5>
                &nbsp;Recuerde revisar los datos que esten escritos correctamente antes de pagar el documento, una vez cancelado el documento no podrá modificarlo 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <div class="tab">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link text-blue active" data-toggle="tab" href="#vendedor" role="tab" aria-selected="false">DATOS DEL VENDEDOR</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-blue" data-toggle="tab" href="#comprador" role="tab" aria-selected="false">DATOS DEL COMPRADOR</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-blue " data-toggle="tab" href="#vehiculo" role="tab" aria-selected="true">DATOS DEL VEHÍCULO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-blue " data-toggle="tab" href="#importe" role="tab" aria-selected="true">IMPORTE DE VENTA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-blue " data-toggle="tab" href="#pago" role="tab" aria-selected="true">PAGAR DOCUMENTO</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="vendedor" role="tabpanel">
                            <div class="pd-20">
                                <?php 
                                //------- BUSCA SOLO VENDEDOR --------//
                                $consultas = [
                                    "SELECT * FROM per_natural WHERE num_doc= '$id_doc' AND tip_desc = 'V'",
                                    "SELECT * FROM per_juridico WHERE num_doc= '$id_doc' AND tip_desc = 'V'",
                                    "SELECT * FROM per_sucesion WHERE num_doc= '$id_doc' AND tip_desc = 'V'"
                                ];
                                foreach ($consultas as $consulta) {
                                    $resultado = $conn->query($consulta);
                                        if ($resultado->num_rows > 0) {
                                            $row = $resultado->fetch_assoc();
                                            switch ($row['tip_tipo']) {
                                                case 'N':
                                                    include('upd_doc/ven/vendedor_natural.php');
                                                    break;
                                                case 'J':
                                                    include('upd_doc/ven/vendedor_juridico.php');
                                                    break;
                                                case 'S':
                                                    include('upd_doc/ven/vendedor_sucesion.php');
                                                    break;
                                                }
                                            break; 
                                        }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="comprador" role="tabpanel">
                            <div class="pd-20">
                                <?php 
                                //------- BUSCA SOLO COMPRADOR --------//
                                $consultas = [
                                    "SELECT * FROM per_natural WHERE num_doc= '$id_doc' AND tip_desc = 'C'",
                                    "SELECT * FROM per_juridico WHERE num_doc= '$id_doc' AND tip_desc = 'C'",
                                    "SELECT * FROM per_sucesion WHERE num_doc= '$id_doc' AND tip_desc = 'C'"
                                ];
                                foreach ($consultas as $consulta) {
                                    $resultado = $conn->query($consulta);
                                        if ($resultado->num_rows > 0) {
                                            $row = $resultado->fetch_assoc();
                                            switch ($row['tip_tipo']) {
                                                case 'N':
                                                    include('upd_doc/com/comprador_natural.php');
                                                    break;
                                                case 'J':
                                                    include('upd_doc/com/comprador_juridico.php');
                                                    break;
                                                case 'S':
                                                    include('upd_doc/ven/vendedor_sucesion.php');
                                                    break;
                                                }
                                            break; 
                                        }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="vehiculo" role="tabpanel">
                            <div class="pd-20">
                                <?php 
                                //------- BUSCA SOLO VEHICULO --------//
                                $a="SELECT * FROM vehiculo_venta WHERE num_doc = '$id_doc' AND id_user = $id_user ";
                                $ares = $conn->query($a);
                                    if ($ares->num_rows > 0) {
                                        $row = $ares->fetch_assoc();
                                        include('upd_doc/vehiculo.php');
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="importe" role="tabpanel">
                            <div class="pd-20">
                                <?php 
                                //------- BUSCA SOLO VEHICULO --------//
                                $a="SELECT * FROM importe_venta WHERE num_doc = '$id_doc' AND id_user = $id_user ";
                                $ares = $conn->query($a);
                                    if ($ares->num_rows > 0) {
                                        $row = $ares->fetch_assoc();
                                        include('upd_doc/importe_venta.php');
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pago" role="tabpanel">
                            <div class="pd-20">
                                <?php include('upd_doc/pagar_doc.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                </div> 
            </div>
        </div>
        <?php include('../layouts/footer.php');?>
<script>
$(document).ready(function(){
    //------- CONDICIONAL PARA CONYUGE NATURAL--------//
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

    //-------- CONDICIONAL PARA VEHICULO ----------//
    $('#clase').focus(function(){
        if($('#clase').val() == 'VEHICULO'){
            $('#ano_veh').on('blur', function() {
                if($('#ano_veh').val() <= 2000){
                    $('#ser_motor_menor').removeAttr('hidden');
                    $('#ser_motor_mayor').attr('hidden', true);
                    $('#serial_motor').val('');
                }else{
                    $('#ser_motor_mayor').removeAttr('hidden');
                    $('#ser_motor_menor').attr('hidden', true);
                }
            })
        }
    })
    $('#uso').focus(function(){
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

    //----- FORM PARA EL VENDEDOR NATURAL-----//
    $('#ven').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '../model/documento/natural/update_vendedor.php',
            type: 'POST',
            data: $('#ven').serialize(),
            success: function(data){
                const res = JSON.parse(data);
                if(res.status == 'error'){
                    swal({
                        title: 'Error al Actualizar',
                        text: res.message,
                        type: 'error',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                    return
                }else{
                    swal({
                        title: 'Actualización Exitosa',
                        text: res.message,
                        type: 'success',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                }
            }
        });
    });
    //----- FORM PARA EL COMPRADOR NATURAL-----//
    $('#com').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '../model/documento/natural/update_comprador.php',
            type: 'POST',
            data: $('#com').serialize(),
            success: function(data){
                const res = JSON.parse(data);
                if(res.status == 'error'){
                    swal({
                        title: 'Error al Actualizar',
                        text: res.message,
                        type: 'error',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                    return
                }else{
                    swal({
                        title: 'Actualización Exitosa',
                        text: res.message,
                        type: 'success',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                }
            }
        });
    });
    //----- FORM PARA EL VENDEDOR JURIDICO-----//
    $('#ven_ju').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '../model/documento/juridico/update_vendedor.php',
            type: 'POST',
            data: $('#ven_ju').serialize(),
            success: function(data){
                const res = JSON.parse(data);
                if(res.status == 'error'){
                    swal({
                        title: 'Error al Actualizar',
                        text: res.message,
                        type: 'error',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                    return
                }else{
                    swal({
                        title: 'Actualización Exitosa',
                        text: res.message,
                        type: 'success',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                }
            }
        });
    });
    //----- FORM PARA EL COMPRADOR JURIDICO-----//
     $('#com_ju').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '../model/documento/juridico/update_comprador.php',
            type: 'POST',
            data: $('#com_ju').serialize(),
            success: function(data){
                const res = JSON.parse(data);
                if(res.status == 'error'){
                    swal({
                        title: 'Error al Actualizar',
                        text: res.message,
                        type: 'error',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                    return
                }else{
                    swal({
                        title: 'Actualización Exitosa',
                        text: res.message,
                        type: 'success',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                }
            }
        });
    });
    //----- FORM PARA EL VEHICULO-----//
    $('#ven_vehi').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '../model/documento/update_vehiculo.php',
            type: 'POST',
            data: $('#ven_vehi').serialize(),
            success: function(data){
                const res = JSON.parse(data);
                if(res.status == 'error'){
                    swal({
                        title: 'Error al Actualizar',
                        text: res.message,
                        type: 'error',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                    return
                }else{
                    swal({
                        title: 'Actualización Exitosa',
                        text: res.message,
                        type: 'success',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                }
            }
        });
    });
    $('#imp_venta').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '../model/documento/importe_venta.php',
            type: 'POST',
            data: $('#imp_venta').serialize(),
            success: function(data){
                const res = JSON.parse(data);
                if(res.status == 'error'){
                    swal({
                        title: 'Error al Actualizar',
                        text: res.message,
                        type: 'error',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                    return
                }else{
                    swal({
                        title: 'Actualización Exitosa',
                        text: res.message,
                        type: 'success',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                }
            }
        });
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
});
    $('.montos').mask('000000000.00', {
        reverse: true
    });
</script>

</body>
</html>