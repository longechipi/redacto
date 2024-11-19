<?php 
require_once('../../conf/conex.php');

$tip_pago = strtoupper(trim($_POST['for_pag']));
$sta_form = trim($_POST['sta_form']);

$a="SELECT tip_pago FROM forma_pago WHERE tip_pago = '$tip_pago'";
$ares= $conn->query($a);
if($ares->num_rows > 0){
    echo json_encode(array('status' => 'error', 'message' => 'Ya Existe una Forma de Pago Registrada'));
    exit;
}else{
    $sql = "INSERT forma_pago(tip_pago, id_sta)VALUES('$tip_pago', $sta_form)";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 'success', 'message' => 'Forma de Pago Registrada Exitosamente'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error al Guardar la Forma de Pago: ' . $conn->error));
    }
}
$conn->close();
?>