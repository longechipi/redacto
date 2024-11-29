<header>
    <link rel="stylesheet" type="text/css" href="../../src/plugins/sweetalert2/sweetalert2.css">
    <script src="../src/plugins/sweetalert2/sweetalert2.all.js"></script>
</header>
<?php 
require_once('conex.php');
include('../utils/utils.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user = limpiarCorreo(trim($_POST['usuario']));

    $a="SELECT nombre, apellido, usuario FROM users WHERE usuario ='$user'";
    $ares= $conn->query($a);
        if ($ares->num_rows > 0){
            $row = $ares->fetch_assoc();
            $nombre = $row['nombre'];
            $apellido = $row['apellido'];
            $full_name = $nombre . ' ' . $apellido;
            $clave_tmp = mt_rand(10000000, 99999999);
            $hash = password_hash($clave_tmp, PASSWORD_DEFAULT);
            $b="UPDATE users SET clave = '$hash' WHERE usuario='$user'";
            $bres= $conn->query($b);
            include_once('../mail/reset-pass.php');
        }else{
            echo '<script>
            swal({
                type: "error",
                title: "Error",
                text: "¡El Usuario Ingresado no existe en nuestra Plataforma!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if(result.value){                   
                    window.location = "../index.html";
                    }
                });
            </script>';
        }




}







?>