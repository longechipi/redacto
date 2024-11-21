<?php 
include('../layouts/header.php');
require('../conf/conex.php');
require('../utils/utils.php');
session_start();
@$id_form = $_POST['id_form'];
validar_post($id_form, 'inicio');

$a="SELECT * FROM forma_pago WHERE id_pag = $id_form; ";
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
                <h5>Editando Forma de Pago: <?php echo $row['tip_pago']; ?></h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="forma_pago">Forma de Pago</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Forma </li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <form id="banco"> 
                <input type="text" name="id_form" value="<?php echo $id_form; ?>" hidden/>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Forma de Pago</label> <span class="text-danger">(*)</span>
                            <input type="text" class="form-control" name="nom_ban" 
                            style="text-transform:uppercase" value="<?php echo $row['tip_pago']; ?>" required>
                            
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Estatus</label> <span class="text-danger">(*)</span>
                            <select name="sta_ban" id="sta_ban" class="form-control" required>
                                <?php
								$b = $conn->query("SELECT id_sta, nom_sta FROM estatus WHERE id_sta IN (1,2)");
								while ($rowa = mysqli_fetch_array($b)) {
									if ($rowa['id_sta'] == $row['id_sta']) {
										echo '<option value="' . $rowa['id_sta'] . '" selected>' . $rowa['nom_sta'] . '</option>';
									} else {
										echo '<option value="' . $rowa['id_sta'] . '">' . $rowa['nom_sta'] . '</option>';
									}
								}
                                $conn->close(); 
                                ?>
                            </select>
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
            url: '../model/form_pago/update_form.php',
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
                        window.location.href = 'forma_pago';
                    });
                    document.getElementById('banco').reset();
                }
            }
        });
    });
});
</script>

</body>
</html>