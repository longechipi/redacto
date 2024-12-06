<?php 
require_once('../../../conf/conex.php');
require_once('../../../utils/utils.php');

$monto_doc = trim($_POST['monto_doc']);
$sta_ban = trim($_POST['sta_ban']);

$a = "INSERT INTO monto_doc(monto, id_sta)VALUES($monto_doc, $sta_ban)";
if ($conn->query($a) === TRUE) {
    echo json_encode(array('status' => 'success', 'message' => 'Monto del Documento Agregado Correctamente'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Error al Guardar El Monto del Documento: ' . $conn->error));
}
$conn->close();
