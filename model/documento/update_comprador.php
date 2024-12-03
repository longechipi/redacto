<?php 
require_once('../../conf/conex.php');
require_once('../../utils/utils.php');

$id_user = $_POST['com_id_user'];
$num_doc = $_POST['com_num_doc'];
$tip_per = $_POST['com_tip_per'];
$nombre1 = strtoupper(trim($_POST['com_nombre1']));
$nombre2 = strtoupper(trim($_POST['com_nombre2']));
$apellido1 = strtoupper(trim($_POST['com_apellido1']));
$apellido2 = strtoupper(trim($_POST['com_apellido2']));
@$nac = $_POST['com_nac'];
$cedula = trim($_POST['com_cedula']);
@$edo_civil = $_POST['com_edo_civil'];
$nom_conyuge = empty($_POST['com_nom_conyuge']) ? NULL : strtoupper(trim($_POST['com_nom_conyuge']));
$ape_conyuge = empty($_POST['com_ape_conyuge']) ? NULL : strtoupper(trim($_POST['com_ape_conyuge']));
$ced_conyuge = empty($_POST['com_ced_conyuge']) ? NULL : trim($_POST['com_ced_conyuge']);

//----------- ACTUALIZACION DE DATOS -----------//
$a="UPDATE per_natural SET nombre1 = '$nombre1', nombre2 = '$nombre2', apellido1 = '$apellido1', apellido2 = '$apellido2', 
nac = '$nac', cedula = '$cedula', civil = '$edo_civil', nom_conyuge = '$nom_conyuge', apel_conyuge = '$ape_conyuge', cedula_conyuge='$ced_conyuge'
WHERE id_user = $id_user AND num_doc = '$num_doc' AND tip_per = 1";
if ($conn->query($a) === TRUE) {
    echo json_encode(array('status' => 'success', 'message' => 'Se Actualizo Exitosamente el Comprador'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Ocurrio un error al Actualizar el Comprador: ' . $conn->error));
}
$conn->close();


?>