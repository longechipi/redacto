<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>DeskApp - Tramitando</title>

	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
</head>

<body>
	<div class="d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="login-box bg-white box-shadow border-radius-10">
						
						<div class="text-center">
						<?php

						if(empty($_GET['id_user']) || empty($_GET['cod'])){ ?>
							<div class="login-title">
								<h2 class="text-center text-primary">Disculpe Ocurrio un Error</h2>
							</div>
							<h3 class='text-center text-primary mb-3'>Parametros Vacios</h3>
							<h5>Por Favor Ingrese o recupere su Clave</h5>
							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mt-5">
										<a href="index.html" class="btn btn-primary btn-lg btn-block" rel="noopener noreferrer">Ingresar</a>
									</div>
								</div>
								<div class="col-2">
									<div class="font-16 weight-600 text-center" data-color="#707373"></div>
								</div>
								<div class="col-5">
									<div class="input-group mt-5">
										<a href="forgot-password.html" class="btn btn-outline-primary btn-lg btn-block" rel="noopener noreferrer">Recuperar Clave</a>
									</div>
								</div>
							</div>
							

					<?php }else{
							$cod = $_GET['cod'];
							$id_user = $_GET['id_user'];

							require('conf/conex.php');
							$a= "SELECT RT.id, RT.id_user, RT.codigo
							FROM registro_tmp RT
							INNER JOIN users U ON RT.id_user = U.id_user
							WHERE RT.id_user = $id_user AND RT.codigo = '$cod'";
							$ares= $conn->query($a);

							if($ares->num_rows > 0){
								$b = "UPDATE users_status SET id_sta = 1 WHERE id_user =  $id_user"; 
								if ($conn->query($b) === TRUE) {
									$c="DELETE FROM registro_tmp WHERE id_user = $id_user AND codigo = '$cod'";
									$cres= $conn->query($c);
								}
								?>
							<div class="login-title">
								<h2 class="text-center text-primary">Felicidades</h2>
							</div>
							<h3 class='text-center text-primary mb-3'>¡Su Usuario esta activo Ingrese en nuestra Plataforma!</h3>

							<div class="row align-items-center">
								<div class="col-md-12 mt-4">
									<div class="text-center">
										<a href="index.html" class="btn btn-primary btn-lg btn-block" rel="noopener noreferrer">Ingresar</a>
									</div>
								</div>
							</div>
							<?php  } else{ ?>
							<div class="login-title">
								<h2 class="text-center text-primary">Disculpe Ocurrio un Error</h2>
							</div>
							<h3 class='text-center text-primary mb-3'>¡La Clave está Vencida! </h3>
							<h5>Por Favor Ingrese o recupere su Clave</h5>

							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mt-5">
										<a href="index.html" class="btn btn-primary btn-lg btn-block" rel="noopener noreferrer">Ingresar</a>
									</div>
								</div>
								<div class="col-2">
									<div class="font-16 weight-600 text-center" data-color="#707373"></div>
								</div>
								<div class="col-5">
									<div class="input-group mt-5">
										<a href="forgot-password.html" class="btn btn-outline-primary btn-lg btn-block" rel="noopener noreferrer">Recuperar Clave</a>
									</div>
								</div>
							</div>
							<?php  }  }?>					
						
							
								
							</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
</body>
</html>