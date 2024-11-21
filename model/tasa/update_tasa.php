<?php 
require_once('../../conf/conex.php');

$tasa_id = trim($_POST['tasa_id']);
$fecha = trim($_POST['fecha']);
$valor = trim($_POST['valor']);
    $a = "UPDATE tasa SET valor = '$valor' WHERE id = $tasa_id";
    if ($conn->query($a) === TRUE) {
        echo json_encode(array('status' => 'success', 'message' => 'Se Actualizo Exitosamente la Tasa BCV'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error al Actualizar la Tasa BCV' . $conn->error));
    }
$conn->close();
?>