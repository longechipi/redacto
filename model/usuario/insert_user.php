<?php 
require_once('../../conf/conex.php');
require_once('../../utils/utils.php');
//---- Datos para la tabla users ----//
$nom_user = strtoupper(trim($_POST['nom_user']));
$apel_user = strtoupper(trim($_POST['apel_user']));
$user = limpiarCorreo(trim($_POST['user']));
$email = limpiarCorreo(trim($_POST['email']));
$telf_error = filter_var(trim($_POST['telf']), FILTER_SANITIZE_NUMBER_INT);
$telf = preg_replace('/[^0-9]/', '', $telf_error);
$pass = password_hash(trim($_POST['pass']), PASSWORD_DEFAULT);
//---- Datos para la tabla users_estatus ----//
$status = $_POST['status'];
//---- Datos para la tabla users_privilegio ----//
$priv = $_POST['priv'];

$a="SELECT usuario FROM users WHERE usuario = '$email'";
$ares= $conn->query($a);
if($ares->num_rows > 0){
    echo json_encode(array('status' => 'error', 'message' => 'Ya Existe el Correo Electrónico en Nuestro Sistema'));
    exit;
}else{
    //---- INSERT EN LA TABLA DE USUARIO ----//
    $b = "INSERT INTO users(nombre, apellido, usuario, correo, telefono, clave)
    VALUES('$nom_user', '$apel_user', '$user', '$email', '$telf', '$pass')";
    if ($conn->query($b) === TRUE) {
        //---- INSERT EN LA TABLA DE USUARIO ESTATUS ----//
        $id_user = mysqli_insert_id($conn);
        $c="INSERT INTO users_status(id_user, id_sta)VALUES($id_user, $status)";
        if ($conn->query($c) === TRUE) {
            //---- INSERT EN LA TABLA DE USUARIO PRIVILEGIOS ----//
            $d="INSERT INTO users_privilegios(id_user, id_pri)VALUES($id_user, $priv)";
            if ($conn->query($d) === TRUE) {
                echo json_encode(array('status' => 'success', 'message' => 'Usuario Registrado Exitosamente'));
            }
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error al Guardar la Forma de Pago: ' . $conn->error));
    }
}
$conn->close();
?>