<?php 
require_once('../../conf/conex.php');

$ban_id = trim($_POST['ban_id']);
$nom_ban = strtoupper(trim($_POST['nom_ban']));
$cod_ban = trim($_POST['cod_ban']);
$sta_ban = trim($_POST['sta_ban']);

$a="SELECT id_ban FROM banco WHERE id_ban = $ban_id";
$ares= $conn->query($a);
if($ares->num_rows <= 0){
    echo json_encode(array('status' => 'error', 'message' => 'El Banco a Editar No Existe'));
    exit;
}else{
    $sql = "UPDATE banco SET banco = '$nom_ban', cod_ban = '$cod_ban', id_sta = $sta_ban WHERE id_ban = $ban_id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 'success', 'message' => 'El Banco Se Actualizo Correctamente'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error al Actualizar el Banco' . $conn->error));
    }
}
$conn->close();
?>