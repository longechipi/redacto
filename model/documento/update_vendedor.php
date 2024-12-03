<?php 
require_once('../../conf/conex.php');
require_once('../../utils/utils.php');

$id_user = $_POST['id_user'];
$num_doc = $_POST['num_doc'];
$tip_per = $_POST['tip_per'];
$nombre1 = strtoupper(trim($_POST['nombre1']));
$nombre2 = strtoupper(trim($_POST['nombre2']));
$apellido1 = strtoupper(trim($_POST['apellido1']));
$apellido2 = strtoupper(trim($_POST['apellido2']));
@$nac = $_POST['nac'];
$cedula = trim($_POST['cedula']);
@$edo_civil = $_POST['edo_civil'];
$nom_conyuge = empty($_POST['nom_conyuge']) ? NULL : strtoupper(trim($_POST['nom_conyuge']));
$ape_conyuge = empty($_POST['ape_conyuge']) ? NULL : strtoupper(trim($_POST['ape_conyuge']));
$ced_conyuge = empty($_POST['ced_conyuge']) ? NULL : trim($_POST['ced_conyuge']);

//----------- ACTUALIZACION DE DATOS -----------//
$a="UPDATE per_natural SET nombre1 = '$nombre1', nombre2 = '$nombre2', apellido1 = '$apellido1', apellido2 = '$apellido2', 
nac = '$nac', cedula = '$cedula', civil = '$edo_civil', nom_conyuge = '$nom_conyuge', apel_conyuge = '$ape_conyuge', cedula_conyuge='$ced_conyuge'
WHERE id_user = $id_user AND num_doc = '$num_doc' AND tip_per = 2";
if ($conn->query($a) === TRUE) {
    echo json_encode(array('status' => 'success', 'message' => 'Se Actualizo Exitosamente el Vendedor'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Ocurrio un error al Actualizar el Vendedor: ' . $conn->error));
}
$conn->close();


?>