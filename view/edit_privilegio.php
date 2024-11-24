<?php 
include('../layouts/header.php');
require('../conf/conex.php');
require('../utils/utils.php');
session_start();
@$id_pri = $_POST['id_pri'];
validar_post($id_pri, 'inicio');

$a="SELECT P.id_pri, P.nom_pri, PM.gestion, PM.configuracion, PM.pagos, PM.reportes, PM.usuarios
FROM privilegios P
LEFT JOIN privilegios_menu PM ON P.id_pri = PM.id_pri 
WHERE P.id_pri = $id_pri ";
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
                <h5>Editando Perfil: <?php echo $row['nom_pri']; ?></h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="privilegios">Privilegios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Privilegio</li>
                </ol>
            </nav>
            
        <div class="card-box pd-20 height-100-p mb-30">
                <input type="text" name="id_pri" value="<?php echo $id_pri; ?>" hidden/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h5>Seleccione Niveles a Mostrar / Ocultar en el Menú Principal</h5>
                        </div>
                        <hr>
                    </div>
                        <hr>
                        
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>
                            <input type="checkbox" id="gestion" class="switch-btn" data-color="#0099ff" <?php echo ($row['gestion'] == 1) ? 'checked' : ''; ?>>
                            GESTIÓN
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>
                            <input type="checkbox" id="configuracion" class="switch-btn" data-color="#0099ff" <?php echo ($row['configuracion'] == 1) ? 'checked' : ''; ?>>
                            CONFIGURACIÓN
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>
                            <input type="checkbox" id="pagos" class="switch-btn" data-color="#0099ff" <?php echo ($row['pagos'] == 1) ? 'checked' : ''; ?>>
                            PAGOS
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>
                            <input type="checkbox" id="reportes" class="switch-btn" data-color="#0099ff" <?php echo ($row['reportes'] == 1) ? 'checked' : ''; ?>>
                            REPORTES
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>
                            <input type="checkbox" id="usuarios" class="switch-btn" data-color="#0099ff" <?php echo ($row['usuarios'] == 1) ? 'checked' : ''; ?>>
                            USUARIOS
                            </label>
                        </div>
                    </div>
                        
                </div>

                <div class="col-md-12 mt-4">
                    <div class="text-center">
                        <a href="javascript:history.back()" class="btn btn-outline-primary" rel="noopener noreferrer"><i class="icon-copy dw dw-curved-arrow1"></i>&nbsp;VOLVER </a>
                    </div>
                </div>
        </div>
        <?php include('../layouts/footer.php');?>
<script>
$(document).ready(function(){
    var elems = Array.prototype.slice.call(document.querySelectorAll('.switch-btn'));
		$('.switch-btn').each(function() {
			new Switchery($(this)[0], $(this).data());
		});
        var checkbox = document.querySelector('.switch-btn');
        $('.switch-btn').click(function (){
            var priviId = <?php echo $id_pri; ?>; 
            var cambio = this.checked ? 1 : 0;
            var menu = this.id;
            $.ajax({
                url: '../model/privilegio/upd_privi.php', 
                type: 'POST',
                data: { priviId: priviId, menu: menu, cambio: cambio },
                success: function(data) {
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