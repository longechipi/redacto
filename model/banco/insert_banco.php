<?php 
require_once('../../conf/conex.php');

$nom_ban = strtoupper(trim($_POST['nom_ban']));
$cod_ban = trim($_POST['cod_ban']);
$sta_ban = trim($_POST['sta_ban']);

$a="SELECT cod_ban FROM banco WHERE cod_ban = $cod_ban";
$ares= $conn->query($a);
if($ares->num_rows > 0){
    echo json_encode(array('status' => 'error', 'message' => 'El Codigo que Introdujo Ya Existe'));
    exit;
}else{
    $sql = "INSERT INTO banco (banco, cod_ban, id_sta) VALUES ('$nom_ban', '$cod_ban', $sta_ban)";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 'success', 'message' => 'Banco Guardado Correctamente'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error al Guardar el Banco: ' . $conn->error));
    }
}

$conn->close();
?>