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
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Fecha del Pago</label> <span class="text-danger">(*)</span>
                            <input type="date" class="form-control" name="fecha_pago" id="fecha_pago" required />
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Monto Cancelado</label> <span class="text-danger">(*)</span>
                            <input type="text" class="form-control" name="monto" required />
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
                            <label>Banco Emisor</label> <span class="text-danger">(*)</span>
                            <select name="ban" class="form-control" id="ban" required>
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
                            <input type="file" class="form-control" name="capture" id="capture" required />
                            <small>Extensiones de archivo permitidas: .jpg, .gif, .jpeg, .png, .pdf </small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"><i class="icon-copy dw dw-floppy-disk"></i>&nbsp;GUARDAR</button>
                            <a href="javascript:history.back()" class="btn btn-outline-primary" rel="noopener noreferrer"><i class="icon-copy dw dw-curved-arrow1"></i>&nbsp;VOLVER </a>
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
    
})


</script>

</body>
</html>