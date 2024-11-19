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
                <h5>Registro Forma de Pago</h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="forma_pago">Forma de Pago</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Registro </li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <form id="form_pag"> 
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Forma de Pago</label> <span class="text-danger">(*)</span>
                            <input type="text" class="form-control" name="for_pag" style="text-transform:uppercase" required>
                            
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Estatus</label> <span class="text-danger">(*)</span>
                            <select name="sta_form" id="sta_form" class="form-control" required>
                                <option value="" disabled selected>SELECCIONAR</option>
                                <option value="1">ACTIVO</option>
                                <option value="2">INACTIVO</option>
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
    $('#form_pag').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '../model/form_pago/insert_form_pago.php',
            type: 'POST',
            data: $('#form_pag').serialize(),
            success: function(data){
                const res = JSON.parse(data);
                if(res.status == 'error'){
                    swal({
                        title: 'Error al registrar',
                        text: res.message,
                        type: 'error',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                    document.getElementById('form_pag').reset();
                }else{
                    swal({
                        title: 'Registro Exitoso',
                        text: res.message,
                        type: 'success',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                    document.getElementById('form_pag').reset();
                }
            }
        });
    });
});
</script>

</body>
</html>