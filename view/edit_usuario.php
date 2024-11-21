<?php 
include('../layouts/header.php');
require('../conf/conex.php');
require('../utils/utils.php');
session_start();

@$user_id = $_POST['user_id'];
validar_post($user_id, 'inicio');

$a="SELECT U.id_user, U.nombre, U.apellido, U.usuario, U.correo, U.telefono,
US.id_sta, E.nom_sta, UP.id_pri, P.nom_pri
FROM users U
LEFT JOIN users_status US ON U.id_user = US.id_user
LEFT JOIN estatus E ON US.id_sta = E.id_sta
LEFT JOIN users_privilegios UP ON U.id_user = UP.id_user
LEFT JOIN privilegios P ON UP.id_pri = P.id_pri
WHERE U.id_user = $user_id;";
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
                <h5>Editando Usuario: <?php echo $row['nombre'] .' ' . $row['apellido']; ?></h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="banco">Usuario</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Usuario</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <form id="banco"> 
                <input type="text" name="ban_id" value="<?php echo $user_id; ?>" hidden/>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Nombre</label> <span class="text-danger">(*)</span>
                            <input type="text" class="form-control" name="nom_user" 
                            style="text-transform:uppercase" value="<?php echo $row['nombre']; ?>" required>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Apellido</label> <span class="text-danger">(*)</span>
                            <input type="text" class="form-control" name="apel_user" 
                            style="text-transform:uppercase" value="<?php echo $row['apellido']; ?>" required>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Usuario</label> <span class="text-danger">(*)</span><span>No se Puede Cambiar</span>
                            <input type="text" class="form-control" name="user_user" readonly
                            style="text-transform:uppercase" value="<?php echo $row['usuario']; ?>" required>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Correo Alternativo</label> <span class="text-danger">(*)</span>
                            <input type="mail" class="form-control" style="text-transform:uppercase" name="mail_user" value="<?php echo $row['correo']; ?>" required>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Teléfono</label> <span class="text-danger">(*)</span>
                            <input type="mail" class="form-control" style="text-transform:uppercase" name="telf" value="<?php echo $row['telefono']; ?>" required>
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
                                
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Privilegio</label> <span class="text-danger">(*)</span>
                            <select name="sta_ban" id="sta_ban" class="form-control" required>
                                <?php
								$c = $conn->query("SELECT id_pri, nom_pri FROM privilegios WHERE id_sta = 1");
								while ($rowc = mysqli_fetch_array($c)) {
									if ($rowc['id_pri'] == $row['id_pri']) {
										echo '<option value="' . $rowc['id_pri'] . '" selected>' . $rowc['nom_pri'] . '</option>';
									} else {
										echo '<option value="' . $rowc['id_pri'] . '">' . $rowc['nom_pri'] . '</option>';
									}
								}
                                $conn->close(); 
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Contraseña</label> <span class="text-danger">(*)</span>
                            <input type="password" class="form-control" style="text-transform:uppercase" name="pass" placeholder="**********"/>
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