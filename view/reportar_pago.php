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
                <h5>Reportar Pagos </h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reportar Pagos</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <form id="rep_pago"> 
                <input type="text" name="id_user" class="form-control" value="<?php echo $id_user; ?>" hidden/>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Fecha del Pago</label> <span class="text-danger">(*)</span>
                            <input type="date" class="form-control" name="fecha_pago" id="fecha_pago"  />
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Monto Cancelado</label> <span class="text-danger">(*)</span>
                            <input type="text" class="form-control monto" name="monto"  />
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Tipo de Pago</label> <span class="text-danger">(*)</span>
                            <select name="tip_pago" class="form-control" id="tip_pago">
                                <option value="" selected disabled>SELECCIONAR</option>
                                <?php 
                                $a="SELECT id_pag, tip_pago FROM forma_pago WHERE id_sta = 1";
                                $ares= $conn->query($a);
                                while($row = $ares->fetch_assoc()){
                                    echo "<option value='".$row['id_pag']."'>".$row['tip_pago']."</option>";
                                }
                                
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Número de Referencia</label> <span class="text-danger">(*)</span>
                            <input type="text" class="form-control" name="refe" />
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Banco Emisor</label> <span class="text-danger">(*)</span>
                            <select name="ban" class="form-control" id="ban" >
                                <option value="" selected disabled>SELECCIONAR</option>
                                <?php 
                                $a="SELECT id_ban, banco FROM banco WHERE id_sta = 1";
                                $ares= $conn->query($a);
                                while($row = $ares->fetch_assoc()){
                                    echo "<option value='".$row['id_ban']."'>".$row['banco']."</option>";
                                }
                                ?>
                                <option value="OTRO">OTRO</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12" id="otro_ban" hidden>
                        <div class="form-group">
                            <label>Nombre del Banco Emisor</label> <span class="text-danger">(*)</span>
                            <input type="text" class="form-control" name="otro_ban" id="banco_otro"/>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Capture del Pago</label> <span class="text-danger">(*)</span>
                            <input type="file" class="form-control" name="capture" id="capture"  />
                            <small>Extensiones de archivo permitidas: .jpg, .webp, .jpeg, .png, .pdf </small>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Seleccione el Documento </label> <span class="text-danger">(*)</span>
                            <select name="doc_num" class="form-control" >
                                <option value="" selected disabled>SELECCIONAR</option>
                                 <?php

                                $b="SELECT IV.id_user, IV.num_doc, IV.id_sta
                                    FROM importe_venta IV
                                    LEFT JOIN estatus E ON IV.id_sta = E.id_sta
                                    LEFT JOIN users U ON IV.id_user = U.id_user
                                    LEFT JOIN documentos_tmp DT ON IV.num_doc = DT.num_doc
                                    WHERE IV.id_user = $id_user AND IV.id_sta = 3
                                    ORDER BY fecha_fin DESC";
                                    $bres= $conn->query($b);
                                    while($brow = $bres->fetch_assoc()){
                                        echo "<option value='".$brow['num_doc']."'>".$brow['num_doc']."</option>";
                                    }
                                    ?>

                            </select>
                            <small>Recuerde Seleccionar el Documento Correcto</small>
                        </div>
                    </div>

                    <div class="col-md-12" id="boton">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"><i class="icon-copy dw dw-floppy-disk"></i>&nbsp;GUARDAR</button>
                            <a href="javascript:history.back()" class="btn btn-outline-primary" rel="noopener noreferrer"><i class="icon-copy dw dw-curved-arrow1"></i>&nbsp;VOLVER </a>
                        </div>
                    </div>
                    <div class="col-md-12" id="loading" hidden>
                        <div class="text-center">
                            <div class="spinner-border text-success" style="width: 5rem; height: 5rem;" role="status" >
                                <span class="sr-only">Loading...</span> 
                            </div>
                            <p>CARGANDO PAGO....</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php include('../layouts/footer.php');?>
<script>
    //------ VALIDAR FECHA DE PAGO ------//
$('#fecha_pago').on('blur', function() {
    validarFecha(this);
})
$('.monto').mask('000000000.00', {
    reverse: true
});

$('#ban').change(function(){
    if($('#ban').val() == 'OTRO'){
        $('#otro_ban').removeAttr('hidden');
        $('#banco_otro').attr('required', true);
    }else{
        $('#otro_ban').attr('hidden', true);
        $('#banco_otro').removeAttr('required', true);
    }

})

$('#rep_pago').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "POST",
        url: "../model/rep_pago/reportar.php",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $('#loading').removeAttr('hidden');
            $('#boton').attr('hidden', true);
        },
        success: function (respon) {
            $('#boton').attr('hidden', true);
            const res = JSON.parse(respon);
                if(res.status == 'error'){
                    swal({
                        title: 'Error',
                        text: res.message,
                        type: 'error',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                }else{
                    swal({
                        title: 'Registro de Pago Exitoso',
                        text: res.message,
                        type: 'success',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if(result.value){
                            window.location.href = 'documentos';
                        }
                    })     
                }
        }
    });
    
})


</script>

</body>
</html>