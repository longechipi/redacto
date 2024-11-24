<?php 
require_once('../../conf/conex.php');

$cambio = $_POST['cambio']; //Estado del Valor
$priviId = $_POST['priviId']; //id del privilegio
$menu = $_POST['menu']; // Id del menu 

$b="SELECT id_pri FROM privilegios_menu WHERE id_pri= $priviId ";
$bres= $conn->query($b);
if($bres->num_rows > 0){
    $a ="UPDATE privilegios_menu SET $menu = $cambio WHERE id_pri = $priviId";
    if ($conn->query($a) === TRUE) {
        echo json_encode(array('status' => 'success', 'message' => 'Se Actualizo el Perfil Exitosamente'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Ocurrio un error al Actualizar el Perfil' . $conn->error));
    }

}else{
    $c ="INSERT INTO privilegios_menu (id_pri, gestion, configuracion, pagos, reportes, usuarios) VALUES ($priviId, 0, 0, 0, 0, 0)";
    if ($conn->query($c) === TRUE) {
        $d ="UPDATE privilegios_menu SET $menu = $cambio WHERE id_pri = $priviId";
        if ($conn->query($d) === TRUE) {
            echo json_encode(array('status' => 'success', 'message' => 'Se Actualizo el Perfil Exitosamente'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Ocurrio un error al Actualizar el Perfil' . $conn->error));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Ocurrio un error al Actualizar el Perfil' . $conn->error));
    }
}
$conn->close();
