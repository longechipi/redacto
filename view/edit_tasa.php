<?php 
include('../layouts/header.php');
require('../conf/conex.php');
require('../utils/utils.php');
session_start();
@$tasa_id = $_POST['tasa_id'];
validar_post($tasa_id, 'inicio');

$a="SELECT * FROM tasa WHERE id = $tasa_id; ";
$ares= $conn->query($a);
$row = $ares->fetch_assoc();
?>
<body>
<?php include('../layouts/navbar.php');?>
<?php include('../layouts/options.php');?>
<?php include('../layouts/menu.php'); ?>
	<div class="mobile-menu-overlay"></div>
	<div class="main-container">
		<div class="pd-ltr-20">
            <div class="title">
                <h5>Editando Tasa fecha: <?php echo $row['fecha']; ?></h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="banco">Tasa</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Tasa</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <form id="banco"> 
                <input type="text" name="tasa_id" value="<?php echo $tasa_id; ?>" hidden/>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Fecha</label> <span class="text-danger">(*)</span>
                            <input type="date" class="form-control" name="fecha" 
                            style="text-transform:uppercase" value="<?php echo $row['fecha']; ?>" readonly required>
                            <small>La fecha No se puede editar</small>
                            
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Monto</label> <span class="text-danger">(*)</span>
                            <input type="text" class="form-control monto" name="valor" value="<?php echo $row['valor']; ?>" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="icon-copy dw dw-floppy-disk"></i>&nbsp;GUARDAR</button>
                        <a href="javascript:history.back()" class="btn btn-outline-primary" rel="noopener noreferrer"><i class="icon-copy dw dw-curved-arrow1"></i>&nbsp;VOLVER </a>
                    </div>
                </div>
            </form>
        </div>
        <?php include('../layouts/footer.php');?>
<script>
$(document).ready(function(){
    $('#banco').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '../model/tasa/update_tasa.php',
            type: 'POST',
            data: $('#banco').serialize(),
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
                    document.getElementById('banco').reset();
                }else{
                    swal({
                        title: 'Actualización Exitosa',
                        text: res.message,
                        type: 'success',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    }).then(function() {
                        window.location.href = 'tasa';
                    });
                    document.getElementById('banco').reset();
                }
            }
        });
    });
    $('.monto').mask('000000000.00', {
		reverse: true
	});
});
</script>

</body>
</html>