<?php 
require_once('../../../conf/conex.php');
require_once('../../../utils/utils.php');

$id_user = $_POST['id_user'];
$num_doc = $_POST['num_doc'];
$id = $_POST['id_jur'];
$nom_emp = strtoupper(trim($_POST['nom_emp']));
$rif = strtoupper(trim($_POST['rif']));
$fec_reg = $_POST['fec_reg'];
$nom_reg = strtoupper(trim($_POST['nom_reg']));
$tomo = trim($_POST['tomo']);
$nro = trim($_POST['nro']);
$protocolo = trim($_POST['protocolo']);
$exp = trim($_POST['exp']);

//----------- ACTUALIZACION DE DATOS -----------//
$a="UPDATE per_juridico SET nom_empresa = '$nom_emp', rif = '$rif', fec_registro = '$fec_reg', nom_registro = '$nom_reg', 
tomo = '$tomo', nro = '$nro', protocolo = '$protocolo', expediente = '$exp'
WHERE num_doc = '$num_doc' AND id_jur = $id AND tip_desc = 'C'";
if ($conn->query($a) === TRUE) {
    echo json_encode(array('status' => 'success', 'message' => 'Se Actualizo Exitosamente el Vendedor'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Ocurrio un error al Actualizar el Vendedor: ' . $conn->error));
}
$conn->close();
