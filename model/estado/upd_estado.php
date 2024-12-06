<?php 
require_once('../../conf/conex.php');

$id_est = trim($_POST['id_est']);
$nom_est = strtoupper(trim($_POST['nom_est']));
$cod_est = strtoupper(trim($_POST['cod_est']));

$a="SELECT id FROM estados WHERE id = $id_est";
$ares= $conn->query($a);
if($ares->num_rows <= 0){
    echo json_encode(array('status' => 'error', 'message' => 'El Estado a Editar No Existe'));
    exit;
}else{
    $sql = "UPDATE estados SET estado = '$nom_est', valor = '$cod_est' WHERE id = $id_est";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 'success', 'message' => 'El Estado Se Actualizo Correctamente'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error al Actualizar el Estado' . $conn->error));
    }
}
$conn->close();
?>