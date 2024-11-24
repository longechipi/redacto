<?php 
include('../layouts/header.php');
require('../conf/conex.php');
require('../utils/utils.php');
session_start();

@$id_ban = $_POST['id_ban'];
validar_post($id_ban, 'inicio');

$a="SELECT * FROM banco WHERE id_ban = $id_ban";
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
                <h5>Editando Banco: <?php echo $row['banco']; ?></h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="banco">Banco</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Banco</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <form id="banco"> 
                <input type="text" name="id_ban" value="<?php echo $id_ban; ?>" hidden/>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Nombre del banco</label> <span class="text-danger">(*)</span>
                            <input type="text" class="form-control" name="nom_ban" 
                            style="text-transform:uppercase" value="<?php echo $row['banco']; ?>" required>
                            
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Codigo del banco</label> <span class="text-danger">(*)</span>
                            <input type="text" maxlength="4" minlength="4" class="form-control" name="cod_ban" value="<?php echo $row['cod_ban']; ?>" required>
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
            url: '../model/banco/update_banco.php',
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
                        window.location.href = 'banco';
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