<?php 
require_once('../../conf/conex.php');

$nom_pri = strtoupper(trim($_POST['nom_pri']));
$sta_pri = trim($_POST['sta_pri']);

$a = "INSERT privilegios(nom_pri, id_sta)VALUES('$nom_pri', $sta_pri)";
if ($conn->query($a) === TRUE) {
    echo json_encode(array('status' => 'success', 'message' => 'Privilegio Registrado Exitosamente'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Error al Guardar Privilegio: ' . $conn->error));
}
$conn->close();
