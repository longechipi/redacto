<?php 
require_once('../../conf/conex.php');

$id_form = trim($_POST['id_form']);
$form_pago = strtoupper(trim($_POST['nom_ban']));
$sta_ban = trim($_POST['sta_ban']);

$a="SELECT id_pag FROM forma_pago WHERE id_pag = '$id_form'";
$ares= $conn->query($a);
if($ares->num_rows <= 0){
    echo json_encode(array('status' => 'error', 'message' => 'Ya Existe una Forma de Pago Registrada'));
    exit;
}else{
    $sql = "UPDATE forma_pago SET tip_pago = '$form_pago', id_sta = $sta_ban WHERE id_pag = $id_form";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 'success', 'message' => 'Se Actualizo Exitosamente la Forma de Pago'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error al Actualizar la Forma de Pago' . $conn->error));
    }
}
$conn->close();
?>