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
<?php   
$a="SELECT * FROM users WHERE id_user = $id_user";
$ares= $conn->query($a);
$row = $ares->fetch_assoc();
?>
	<div class="main-container">
		<div class="pd-ltr-20">
            <div class="title">
                <h5>Perfil del Usuario</h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <form id="banco"> 
                <input type="text" name="user_id" value="<?php echo $id_user; ?>" hidden/>
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
                            <label>Correo Alternativo</label> <span class="text-danger">(*)</span>
                            <input type="mail" class="form-control" style="text-transform:uppercase" name="mail_user" value="<?php echo $row['correo']; ?>" required>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="form-group">
                            <label for="telf">Teléfono:</label>
                            <input type="text" name="telf" id="telf" maxlength="12" minlength="12" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" value="<?php echo $row['telefono']; ?>" required />
                        </div>
                    </div>
                    <script>
                        const input = document.querySelector("#telf");
                        window.intlTelInput(input, {
                            loadUtilsOnInit: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/js/utils.js",
                            initialCountry: "ve",
                        });
                    </script>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Contraseña</label> <span class="text-danger">(*)</span>
                            <input type="password" class="form-control" minlength="6" style="text-transform:uppercase" name="pass" placeholder="**********"/>
                            <small class="form-text text-muted">La contraseña debe contener al menos 6 caracteres.</small>
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
            url: '../model/usuario/perfil.php',
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
});
</script>

</body>
</html>