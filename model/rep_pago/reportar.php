<?php 
require_once('../../conf/conex.php');

$id_user = $_POST['id_user'];
$fecha_pago = $_POST['fecha_pago'];
$monto = trim($_POST['monto']);
$tip_pago = $_POST['tip_pago'];
$refe = trim($_POST['refe']);
$ban = $_POST['ban'];
$otro_ban = empty($_POST['otro_ban']) ? NULL : strtoupper(trim($_POST['otro_ban']));
$doc_num = $_POST['doc_num'];
$image = $_FILES['capture'];
$fecha = date('Y-m-d');

//------ CONSULTA PARA DATOS PARA EL CORREO DEL USUARIO Y DEL ADMIN -------//
$b="SELECT CONCAT(nombre, ' ', apellido) AS nom_user, usuario, correo FROM users WHERE id_user = $id_user";
$bres = $conn->query($b);
$brow = $bres->fetch_assoc();
$nom_user = $brow['nom_user'];
$usuario = $brow['usuario'];
$correo = $brow['correo'];


if ($image['error'] === 0) {
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp', 'pdf'];
    $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $target_dir = "../../upload/";
    if (in_array(strtolower($file_extension), $allowed_extensions)) {
        
        $nom_file = $doc_num . '--' . $id_user . '--' . uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $nom_file;
        if (move_uploaded_file($image['tmp_name'], $target_file)) {
            $a="INSERT INTO reporte_pago (id_user, fecha_pago, monto, tip_pag, refe, id_ban, otro_ban, capture, num_doc, id_sta, fec_cargo)
                VALUES($id_user, '$fecha_pago', $monto, $tip_pago, '$refe', $ban, '$otro_ban', '$target_file', '$doc_num', 4, '$fecha')";
                if ($conn->query($a) === TRUE) {
                    //------- ACTUALIZACION DEL ESTATUS DE LA TABLA TEMPORAL --------//
                    $c="UPDATE documentos_tmp SET id_sta = 4 WHERE num_doc= '$doc_num'";
                    $cres = $conn->query($c);
                    //------- ACTUALIZACION DEL ESTATUS importe_venta --------//
                    $d="UPDATE importe_venta SET id_sta = 4 WHERE num_doc= '$doc_num'";
                    $dres = $conn->query($d);
                     //------- ACTUALIZACION DEL ESTATUS importe_venta --------//
                    $e="UPDATE vehiculo_venta SET id_sta = 4 WHERE num_doc= '$doc_num'";
                    $eres = $conn->query($e);
                    //------- ACTUALIZACION DEL ESTATUS EN LAS TABLAS DONDE ESTE EL DOCUMENTO --------//
                    $consultas = [
                        "SELECT * FROM per_natural WHERE num_doc= '$doc_num'",
                        "SELECT * FROM per_juridico WHERE num_doc= '$doc_num'",
                        "SELECT * FROM per_sucesion WHERE num_doc= '$doc_num'"
                    ];
                    foreach ($consultas as $consulta) {
                        $resultado = $conn->query($consulta);
                        if ($resultado->num_rows > 0) {
                            $fila = $resultado->fetch_assoc();
                    
                            switch (true) {
                                case strpos($consulta, 'per_natural'):                
                                    $consulta_update = "UPDATE per_natural SET id_sta = 4 WHERE num_doc = '$doc_num'";
                                    break;
                                case strpos($consulta, 'per_juridico'):
                                    $consulta_update = "UPDATE per_juridico SET id_sta = 4 WHERE num_doc = '$doc_num'";
                                    break;
                                case strpos($consulta, 'per_sucesion'):
                                    $consulta_update = "UPDATE per_sucesion SET id_sta = 4 WHERE num_doc = '$doc_num'";
                                    break;
                            }
                            if (isset($consulta_update)) {
                                $fres = $conn->query($consulta_update);
                                    continue;
                                }
                        }
                    }
                    include('../../mail/reporte-pago.php');
                    echo json_encode(array('status' => 'success', 'message' => 'Se Agrego el Pago, por favor espere mientras se valida el pago, su documento sera enviado por su Correo'));
                }else{
                    echo json_encode(array('status' => 'error', 'message' => 'Ocurrio un error al Agregar el Pago '));
                }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Ocurrio un error al subir la imagen del pago'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Las extensiones permitidas por el sistema son jpg, jpeg, png, webp, y pdf'));
    }
}