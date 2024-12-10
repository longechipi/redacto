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
            include('../mail/reset-pass.php');
            echo json_encode(array('status' => 'success', 'message' => 'Se envio un Correo con la nueva Credencial temporal, recuerde cambiarla para mantener su seguridad'));
        }else{
            echo json_encode(array('status' => 'error', 'message' => '¡El Usuario Ingresado no existe en nuestra Plataforma!'));
            
        }

}
$conn->close();
?>