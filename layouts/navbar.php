<?php
require('../conf/conex.php');
date_default_timezone_set('America/Caracas');
if (!$_SESSION['loggedin'] == true) {
    header('location: ../index.html');
}
$z="SELECT * FROM tasa ORDER BY fecha DESC LIMIT 1";
$zres= $conn->query($z);
if ($zres->num_rows > 0) {
	$zrow = $zres->fetch_assoc();
	$tasaBCV=$zrow["valor"];
}else{
	$tasaBCV=0.00;
}

?>
<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<!-- <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div> -->
			<div class="header-search">
				<strong>Tasa BCV del Dia: </strong><?php echo date('d-m-Y') .'<strong> || </strong>'. round($tasaBCV, 2) .' ' ."Bs"; ?> 
			</div>
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>
			<!-- <div class="user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
						<i class="icon-copy dw dw-notification"></i>
						<span class="badge notification-active"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<li>
									<a href="#">
										<img src="../vendors/images/img.jpg" alt="">
										<h3>John Doe</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="../vendors/images/photo1.jpg" alt="">
										<h3>Lea R. Frith</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="../vendors/images/photo2.jpg" alt="">
										<h3>Erik L. Richards</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="../vendors/images/photo3.jpg" alt="">
										<h3>John Doe</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="../vendors/images/photo4.jpg" alt="">
										<h3>Renee I. Hansen</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="../vendors/images/img.jpg" alt="">
										<h3>Vicki M. Coleman</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div> -->
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							
						</span>
						<span class="user-name"><?php echo $_SESSION['nombre']; ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="perfil"><i class="dw dw-user1"></i> Perfil</a>
						<!-- <a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a> -->
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Ayuda</a>
						<a class="dropdown-item" href="../salir.php"><i class="dw dw-logout"></i> Salir</a>
					</div>
				</div>
			</div>
		</div>
	</div>