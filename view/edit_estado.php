<?php 
include('../layouts/header.php');
require('../conf/conex.php');
require('../utils/utils.php');
session_start();

@$id_est = $_POST['id_est'];
validar_post($id_est, 'inicio');

$a="SELECT * FROM estados WHERE id = $id_est";
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
                <h5>Editando Estado: <?php echo utf8_encode($row['estado']); ?></h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="banco">Estados</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Estado</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <form id="estado"> 
                <input type="text" name="id_est" value="<?php echo $id_est; ?>" hidden/>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Nombre del Estado</label> <span class="text-danger">(*)</span>
                            <input type="text" class="form-control" name="nom_est" 
                            style="text-transform:uppercase" value="<?php echo utf8_encode($row['estado']); ?>" required>
                            
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Codigo del estado</label> <span class="text-danger">(*)</span>
                            <input type="text" maxlength="2" minlength="2" class="form-control" name="cod_est" value="<?php echo $row['valor']; ?>" required>
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
    $('#estado').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '../model/estado/upd_estado.php',
            type: 'POST',
            data: $('#estado').serialize(),
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
                    document.getElementById('estado').reset();
                }else{
                    swal({
                        title: 'Actualización Exitosa',
                        text: res.message,
                        type: 'success',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    }).then(function() {
                        window.location.href = 'estados';
                    });
                    document.getElementById('estado').reset();
                }
            }
        });
    });
});
</script>

</body>
</html>