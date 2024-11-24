<?php 
include('../layouts/header.php');
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
                <h5>Registro Usuario</h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="usuarios">Usuarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Registro</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <form id="user"> 
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Nombre</label> <span class="text-danger">(*)</span>
                            <input type="text" class="form-control" name="nom_user" style="text-transform:uppercase" required />
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Apellido</label> <span class="text-danger">(*)</span>
                            <input type="text" class="form-control" name="apel_user" style="text-transform:uppercase" required />
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Usuario (Correo)</label> <span class="text-danger">(*)</span>
                            <input type="email" class="form-control" name="user" required />
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Correo Alterno</label> <span class="text-danger">(*)</span>
                            <input type="text" class="form-control" name="email" required />
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="form-group">
                            <label for="telf">Teléfono:</label>
                            <input type="text" name="telf" id="telf" maxlength="12" minlength="12" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  required />
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
                            <label>Estatus</label> <span class="text-danger">(*)</span>
                            <select name="status" id="status" class="form-control" required>
                                <option value="" disabled selected>SELECCIONAR</option>
                                <option value="1">ACTIVO</option>
                                <option value="2">INACTIVO</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Privilegio</label> <span class="text-danger">(*)</span>
                            <select name="priv" id="priv" class="form-control" required>
                                <option value="" disabled selected>SELECCIONAR</option>
                                <?php 
                                    $a = "SELECT * FROM privilegios WHERE id_sta = 1";
                                    $ares= $conn->query($a);
                                    while($row = $ares->fetch_assoc()){
                                        echo "<option value='".$row['id_pri']."'>".$row['nom_pri']."</option>";
                                    }
                                    $conn->close();
                                    ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Contraseña</label> <span class="text-danger">(*)</span>
                            <input type="text" class="form-control" name="pass" required />
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
    $('#user').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '../model/usuario/insert_user.php',
            type: 'POST',
            data: $('#user').serialize(),
            success: function(data){
                const res = JSON.parse(data);
                if(res.status == 'error'){
                    swal({
                        title: 'Error al registrar el Usuario',
                        text: res.message,
                        type: 'error',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                    document.getElementById('user').reset();
                }else{
                    swal({
                        title: 'Usuario Registrado con Exito',
                        text: res.message,
                        type: 'success',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                    document.getElementById('user').reset();
                }
            }
        });
    });
});
</script>

</body>
</html>