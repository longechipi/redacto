<?php 
require_once('../../conf/conex.php');
require_once('../../utils/utils.php');

$user_id = trim($_POST['user_id']);
$nom_user = strtoupper(trim($_POST['nom_user']));
$apel_user = strtoupper(trim($_POST['apel_user']));
$mail_user = limpiarCorreo(trim($_POST['mail_user']));
$telf = trim($_POST['telf']);
$esta_user = trim($_POST['esta_user']);
$est_pri = trim($_POST['est_pri']);
$pass = password_hash(trim($_POST['pass']), PASSWORD_DEFAULT);

$a="SELECT correo FROM users WHERE usuario = '$mail_user'";
$ares= $conn->query($a);
if($ares->num_rows > 0){
    echo json_encode(array('status' => 'error', 'message' => 'Ya Existe el Correo Electrónico en Nuestro Sistema'));
    exit;
}else{
    //---- UPDATE EN LA TABLA DE USUARIO ----//
    $b="UPDATE users SET nombre = '$nom_user', apellido= '$apel_user', correo= '$mail_user', telefono='$telf', clave = '$pass'
    WHERE id_user= $user_id";
        if ($conn->query($b) === TRUE){
            $c="UPDATE users_status SET id_sta = $esta_user WHERE id_user = $user_id";
                if ($conn->query($c) === TRUE){
                    $d="UPDATE users_privilegios SET id_pri = $est_pri WHERE id_user = $user_id";
                    if ($conn->query($d) === TRUE) {
                        echo json_encode(array('status' => 'success', 'message' => 'Usuario Actualizado Exitosamente'));
                    }else{
                        echo json_encode(array('status' => 'error', 'message' => 'Error al Actualizar el Usuario' . $conn->error));
                        exit;
                    }
                }else{
                    echo json_encode(array('status' => 'error', 'message' => 'Error al Actualizar el Estado del Usuario' . $conn->error));
                    exit;
                }
        }else{
            echo json_encode(array('status' => 'error', 'message' => 'Error al Actualizar el Usuario' . $conn->error));
            exit;
        }
}
$conn->close();
?>