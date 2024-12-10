<?php 
require_once('../../conf/conex.php');
require_once('../../utils/utils.php');

$user_id = trim($_POST['user_id']);
$nom_user = strtoupper(trim($_POST['nom_user']));
$apel_user = strtoupper(trim($_POST['apel_user']));
$mail_user = limpiarCorreo(trim($_POST['mail_user']));
$telf_error = filter_var(trim($_POST['telf']), FILTER_SANITIZE_NUMBER_INT);
$telf = preg_replace('/[^0-9]/', '', $telf_error);


    //---- UPDATE EN LA TABLA DE USUARIO ----//
    $b="UPDATE users SET nombre = '$nom_user', 
    apellido= '$apel_user', 
    correo= '$mail_user', 
    telefono='$telf'"; 
    if (!empty($_POST['pass'])) {
        $pass = password_hash(trim($_POST['pass']), PASSWORD_DEFAULT);
        $b .= ", clave = '$pass'";
    }
    
    $b .= " WHERE id_user = $user_id";
        if ($conn->query($b) === TRUE){
            echo json_encode(array('status' => 'success', 'message' => 'Usuario Actualizado Exitosamente'));
        }else{
            echo json_encode(array('status' => 'error', 'message' => 'Error al Actualizar el Usuario' . $conn->error));
            exit;
        }
$conn->close();
?>