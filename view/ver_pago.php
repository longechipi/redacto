<?php 
include('../layouts/header.php');
require('../conf/conex.php');
require('../utils/utils.php');
session_start();
@$id_pag = $_POST['id_pag'];
validar_post($id_pag, 'inicio');

$a="SELECT RP.id_pag, RP.id_user, CONCAT(U.apellido, ' ', U.nombre) AS nom_user,
RP.fecha_pago, RP.monto, RP.tip_pag, FP.tip_pago, RP.refe, RP.id_ban, B.banco,
RP.capture, RP.num_doc, RP.fec_cargo, RP.id_sta, E.nom_sta
FROM reporte_pago RP
LEFT JOIN users U ON RP.id_user = U.id_user
LEFT JOIN forma_pago FP ON RP.tip_pag = FP.id_pag
LEFT JOIN banco B ON RP.id_ban = B.id_ban
LEFT JOIN estatus E ON RP.id_sta = E.id_sta
WHERE RP.id_pag = $id_pag";
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
                <h5>Verificando Pago</h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pago</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <form id="banco"> 
                <input type="text" name="id_pago" value="<?php echo $id_pag; ?>" hidden/>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <p><strong>Usuario: </strong><?php echo $row['nom_user']; ?></p> 
                            <p><strong>Fecha del Pago: </strong><?php echo $row['fecha_pago']; ?></p> 
                            <p><strong>Monto: </strong><?php echo $row['monto']; ?></p> 
                            <p><strong>Tipo del Pago: </strong><?php echo $row['tip_pago']; ?></p> 
                            
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                        <p><strong>Referencia: </strong><?php echo $row['refe']; ?></p> 
                        <p><strong>Banco Emisor: </strong><?php echo $row['banco']; ?></p>
                        <p><strong>Documento Cancelado: </strong><?php echo $row['num_doc']; ?></p> 
                        <p><strong>Fecha que Reporto Pago: </strong><?php echo $row['fec_cargo']; ?></p> 
                        </div>
                    </div>         
                </div>

                <div class="gallery-wrap">
                    <ul class="row">
                        <li class="col-lg-4 col-md-6 col-sm-12">
                            <div class="da-card box-shadow">
                                <div class="da-card-photo">
                                    <img src="../upload/<?php echo $row['capture']; ?>" alt="">
                                    <div class="da-overlay">
                                        <div class="da-social">
                                        <h5 class="mb-10 color-white pd-20">Lorem ipsum dolor sit amet, consectetur adipisicing.</h5>
                                            <ul class="clearfix">
                                                <li><a href="../upload/<?php echo $row['capture']; ?>" data-fancybox="images"><i class="fa fa-picture-o"></i></a></li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
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
        <script src="../src/plugins/fancybox/dist/jquery.fancybox.js"></script>
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