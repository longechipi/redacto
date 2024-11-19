<?php 
date_default_timezone_set('America/Caracas');
if (!$_SESSION['loggedin'] == true) {
    header('location: ../index.html');
}
 //-------- SESSIONES DE USAURIO --------//
$id_user = $_SESSION['id_user'];
$privilegios = $_SESSION['id_pri'];
$estatus = $_SESSION['id_sta'];
$user = $_SESSION['usuario'];
$fullname = $_SESSION['nombre'];
?>

<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.html">
            <img src="../vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
            <img src="../vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>

    <?php 
   switch ($privilegios) {
    //---- menu para Admin ----//
    case 1:
        include '../layouts/nav/menu-admin.php';
        break;
    //---- menu para Asistentes ----//
    case 2:
        include '../layouts/nav/menu-asis.php';
        break;
    //---- menu para Usuarios ----//
    case 3:
        include '../layouts/nav/menu-user.php';
        break;
   }
    ?>	
</div> 