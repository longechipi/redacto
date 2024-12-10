<?php 
require_once('../../conf/conex.php');
require_once('../../utils/utils.php');

$id = $_POST['id_imp'];
$id_user = $_POST['id_user'];
$num_doc = $_POST['num_doc'];
$ciudad = strtoupper(trim($_POST['ciudad']));
$estado = strtoupper(trim($_POST['estado']));
$divisa = trim($_POST['divisa']);
$tasa = trim($_POST['tasa']);
$bs = trim($_POST['bs']);
$fecha = date('Y-m-d');

    //------- ACTUALIZACION EN LA TABLA SI EL ESTADO ES IGUAL --------- //
    $a ="UPDATE importe_venta SET ciudad ='$ciudad', estado ='$estado', 
    monto_usd = $divisa, tasa = $tasa, monto_bs = $bs, fecha = '$fecha' WHERE num_doc = '$num_doc'
    AND id_imp = $id ";

        if ($conn->query($a) === TRUE) {
            echo json_encode(array('status' => 'success', 'message' => 'Se Actualizo Exitosamente los datos de Venta'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Ocurrio un error al Actualizar los datos de Venta: ' . $conn->error));
        }

$conn->close();
?>