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
                    <li class="breadcrumb-item"><a href="usuarios">Usuario</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Registro</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <form id="banco"> 
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

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Telefono</label> <span class="text-danger">(*)</span>
                            <input type="text" class="form-control" name="telf" required />
                        </div>
                    </div>

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
    $('#banco').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '../model/banco/insert_banco.php',
            type: 'POST',
            data: $('#banco').serialize(),
            success: function(data){
                const res = JSON.parse(data);
                if(res.status == 'error'){
                    swal({
                        title: 'Error al registrar el banco',
                        text: res.message,
                        type: 'error',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                    document.getElementById('banco').reset();
                }else{
                    swal({
                        title: 'Banco Registrado con Exito',
                        text: res.message,
                        type: 'success',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                    document.getElementById('banco').reset();
                }
            }
        });
    });
});
</script>

</body>
</html>