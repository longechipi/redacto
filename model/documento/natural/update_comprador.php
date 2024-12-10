<?php 
require_once('../../../conf/conex.php');
require_once('../../../utils/utils.php');

$id_user = $_POST['id_user'];
$num_doc = $_POST['num_doc'];
$id = $_POST['id_nat'];
$nombre1 = strtoupper(trim($_POST['nombre1']));
$nombre2 = strtoupper(trim($_POST['nombre2']));
$apellido1 = strtoupper(trim($_POST['apellido1']));
$apellido2 = strtoupper(trim($_POST['apellido2']));
@$nac = $_POST['nac'];
$cedula = trim($_POST['cedula']);
@$edo_civil = $_POST['edo_civil'];

//----------- ACTUALIZACION DE DATOS -----------//
$a="UPDATE per_natural SET nombre1 = '$nombre1', nombre2 = '$nombre2', apellido1 = '$apellido1', apellido2 = '$apellido2', 
nac = '$nac', cedula = '$cedula', civil = '$edo_civil'
WHERE num_doc = '$num_doc' AND tip_per = 1 AND id_nat = $id AND tip_desc = 'C'";
if ($conn->query($a) === TRUE) {
    echo json_encode(array('status' => 'success', 'message' => 'Se Actualizo Exitosamente el Comprador'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Ocurrio un error al Actualizar el Comprador: ' . $conn->error));
}
$conn->close();


?>