<?php 
require_once('../../conf/conex.php');
//---- Datos para la tabla users ----//
$nom_user = strtoupper(trim($_POST['nom_user']));
$apel_user = strtoupper(trim($_POST['apel_user']));
$user = trim($_POST['user']); //FILTRO DE CORREO
$email = trim($_POST['email']); //FILTRO DE CORREO
$telf = trim($_POST['telf']); //LIBRERIA DE TELEFONO
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
        $c="INSERT INTO users_status(id_user, id_sta)VALUES('PENDIENTE', $status)";
        if ($conn->query($c) === TRUE) {
            //---- INSERT EN LA TABLA DE USUARIO PRIVILEGIOS ----//
            $d="INSERT INTO users_privilegios(id_user, id_pri)VALUES('PENDIENTE', $priv)";
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