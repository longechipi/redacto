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
			<?php 
			if($privilegios == 1){
				include('../view/ini/administrador.php');
			}else if($privilegios == 2){
				include('../view/ini/asistente.php');
			}elseif($privilegios == 4){
				include('../view/ini/usuario.php');
			}else{
				include('../view/ini/usuario.php');
			}
			
			?>
<?php include('../layouts/footer.php');?>
</body>
</html>