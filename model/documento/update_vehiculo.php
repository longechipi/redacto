<?php 
require_once('../../conf/conex.php');
require_once('../../utils/utils.php');
$id = $_POST['id_ven'];
$id_user = $_POST['id_user'];
$num_doc = $_POST['num_doc'];
$reg_veh = trim($_POST['reg_veh']);
$fec_cert = trim($_POST['fec_cert']);
$clase = trim($_POST['clase']);
$modelo = strtoupper(trim($_POST['modelo']));
$ano_veh = trim($_POST['ano_veh']);
$tipo = trim($_POST['tipo']);
$color = strtoupper(trim($_POST['color']));
$placa = strtoupper(trim($_POST['placa']));
$marca = strtoupper(trim($_POST['marca']));
$uso = trim($_POST['uso']);
$otro_uso = empty($_POST['otro_uso']) ? NULL : strtoupper(trim($_POST['otro_uso']));
$serial_carro = strtoupper(trim($_POST['serial_carro']));
$serial_motor = empty($_POST['serial_motor']) ? trim($_POST['ser_motor']) : trim($_POST['serial_motor']);

//------- ACTUALIZACION EN LA TABLA --------- //
$a="UPDATE vehiculo_venta SET reg_vehiculo = '$reg_veh', fec_certi= '$fec_cert', clase = '$clase', modelo = '$modelo', 
anio = '$ano_veh', tipo = '$tipo', color = '$color', placa = '$placa', marca = '$marca', uso = '$uso', otro_uso = '$otro_uso', 
serial_carro = '$serial_carro', serial_motor = '$serial_motor' 
WHERE num_doc = '$num_doc' AND id_ven = $id";
if ($conn->query($a) === TRUE) {
    echo json_encode(array('status' => 'success', 'message' => 'Se Actualizo Exitosamente el Vendedor'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Ocurrio un error al Actualizar el Vendedor: ' . $conn->error));
}
$conn->close();
?>