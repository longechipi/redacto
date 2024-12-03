<?php 
require_once('../../conf/conex.php');
//Variables Globales//
$id_user = $_POST['id_user'];

//------------- CAMPOS DEL PRIMER STEP ------------//
//--------- CAMPOS DE NATURAL ---------//
$tip_per = $_POST['tip_per'];
$nombre1 = strtoupper(trim($_POST['nombre1']));
$nombre2 = strtoupper(trim($_POST['nombre2']));
$apellido1 = strtoupper(trim($_POST['apellido1']));
$apellido2 = strtoupper(trim($_POST['apellido2']));
$nac = $_POST['nac'];
$cedula = $_POST['cedula'];
$edo_civil = $_POST['edo_civil'];
//-------- Si es Casado --------//
$nom_conyuge = empty($_POST['nom_conyuge']) ? NULL : strtoupper(trim($_POST['nom_conyuge']));
$ape_conyuge = empty($_POST['ape_conyuge']) ? NULL : strtoupper(trim($_POST['ape_conyuge']));
$ced_conyuge = empty($_POST['ced_conyuge']) ? NULL : $_POST['ced_conyuge'];
//--------- CAMPOS DE JURIDICO ---------//
$nom_emp = strtoupper(trim($_POST['nom_emp']));
$rif = trim($_POST['rif']);
$fec_reg = trim($_POST['fec_reg']);
$nom_reg = strtoupper(trim($_POST['nom_reg']));
$tomo = trim($_POST['tomo']);
$nro = trim($_POST['nro']);
$protocolo = trim($_POST['protocolo']);
$exp = trim($_POST['exp']);
//--------- CAMPOS DE SUCESION ---------//
$nom_suc = strtoupper(trim($_POST['nom_suc']));
$rif_su = trim($_POST['rif_su']);
$cer_sol = trim($_POST['cer_sol']);
//------------- FIN DE CAMPOS DEL PRIMER STEP ------------//
///////////////////////////////////////////////////////////
//------------- CAMPOS DEL SEGUNDO STEP ------------//
//--------- CAMPOS DE NATURAL ---------//
$com_tip_per = $_POST['com_tip_per'];
$com_nombre1 = strtoupper(trim($_POST['com_nombre1']));
$com_nombre2 = strtoupper(trim($_POST['com_nombre2']));
$com_apellido1 = strtoupper(trim($_POST['com_apellido1']));
$com_apellido2 = strtoupper(trim($_POST['com_apellido2']));
$com_nac = trim($_POST['com_nac']);
$com_cedula = trim($_POST['com_cedula']);
$com_edo_civil = trim($_POST['com_edo_civil']);
//-------- Si es Casado --------//
$com_nom_conyuge = empty($_POST['com_nom_conyuge']) ? NULL : strtoupper(trim($_POST['com_nom_conyuge']));
$com_ape_conyuge = empty($_POST['com_ape_conyuge']) ? NULL : strtoupper(trim($_POST['com_ape_conyuge']));
$com_ced_conyuge = empty($_POST['com_ced_conyuge']) ? NULL : $_POST['com_ced_conyuge'];
//--------- CAMPOS DE JURIDICO ---------//
$com_nom_emp = strtoupper(trim($_POST['com_nom_emp']));
$com_rif = trim($_POST['com_rif']);
$com_fec_reg = trim($_POST['com_fec_reg']);
$com_nom_reg = strtoupper(trim($_POST['com_nom_reg']));
$com_tomo = trim($_POST['com_tomo']);
$com_nro = trim($_POST['com_nro']);
$com_protocolo = trim($_POST['com_protocolo']);
$com_exp = trim($_POST['com_exp']);
//--------- CAMPOS DE SUCESION ---------//
$com_nom_suc = strtoupper(trim($_POST['com_nom_suc']));
$com_rif_su = trim($_POST['com_rif_su']);
$com_cer_sol = trim($_POST['com_cer_sol']);
// //------------- FIN DE CAMPOS DEL SEGUNDO STEP ------------//
// ////////////////////////////////////////////////////////////
// //------------- CAMPOS DEL TERCER STEP ------------//
$reg_veh = trim($_POST['reg_veh']);
$fec_cert = trim($_POST['fec_cert']);
$clase = trim($_POST['clase']);
$modelo = strtoupper(trim($_POST['modelo']));
$ano_veh = trim($_POST['ano_veh']);
$tipo = strtoupper(trim($_POST['tipo']));
$color = strtoupper(trim($_POST['color']));
$placa = strtoupper(trim($_POST['placa']));
$marca = strtoupper(trim($_POST['marca']));
$uso = strtoupper(trim($_POST['uso']));
$serial_carro = strtoupper(trim($_POST['serial_carro']));

$serial_motor = empty($_POST['serial_motor']) ? trim($_POST['ser_motor']) : trim($_POST['serial_motor']);
// //------------- FIN DE CAMPOS DEL TERCER STEP ------------//
// ////////////////////////////////////////////////////////////
// //------------- CAMPOS DEL CUARTO STEP ------------//
$divisa = $_POST['divisa'];
$tasa = $_POST['tasa'];
$total_venta = $_POST['bs'];
$ciudad = $_POST['ciudad'];
$estado = $_POST['estado'];
$fecha =date('Y-m-d');
//------------- FIN DE CAMPOS DEL CUARTO STEP ------------//


//--------- REGISTRO DE DOCUMENTO ---------//
$a="SELECT est, cod, anio FROM correlativo WHERE est = '$estado'";
$ares= $conn->query($a);
    if($ares->num_rows > 0){
        $row = $ares->fetch_assoc();
        $cod_num = intval($row['cod']) + 1;
        $cod = str_pad($cod_num, 6, '0', STR_PAD_LEFT);
        $b="UPDATE correlativo SET cod= '$cod', anio= YEAR(NOW()) WHERE est = '$estado'";
        $bres= $conn->query($b);
    }else{
        $cod_num = intval(1);
        $cod = str_pad($cod_num, 6, '0', STR_PAD_LEFT);
        $b="INSERT INTO correlativo(est, cod, anio) VALUES('$estado', '$cod', YEAR(NOW()))";
        $bres= $conn->query($b);
    }

//------- BUSQUEDA DEL DOCUMENTO --------//
$c="SELECT est, cod, anio FROM correlativo WHERE est = '$estado'";
$cres= $conn->query($c);
$row = $cres->fetch_assoc();
$num_doc = $row['est'].'-'.$row['cod'].'-'.$row['anio'];

//------------- INSERT EN LA TABLA DE VENDEDOR -----------//
if(($tip_per == 'N') || ($com_tip_per == 'N')){
    $d="INSERT INTO per_natural(id_user, tip_per, nombre1, nombre2, apellido1, apellido2, nac, 
    cedula, civil, nom_conyuge, apel_conyuge, cedula_conyuge, num_doc, id_sta)
    VALUES($id_user, 2, '$nombre1', '$nombre2', '$apellido1', '$apellido2', '$nac', 
    '$cedula', '$edo_civil', '$nom_conyuge', '$ape_conyuge', '$ced_conyuge', '$num_doc', 3)";
        if ($conn->query($d) === TRUE) {
            //----------- INSERT EN LA TABLA COMPRADOR ------------//
            $e="INSERT INTO per_natural(id_user, tip_per, nombre1, nombre2, apellido1, apellido2, nac, 
            cedula, civil, nom_conyuge, apel_conyuge, cedula_conyuge, num_doc, id_sta)
            VALUES($id_user, 1, '$com_nombre1', '$com_nombre2', '$com_apellido1', '$com_apellido2', '$com_nac', 
            '$com_cedula', '$com_edo_civil', '$com_nom_conyuge', '$com_ape_conyuge', '$com_ced_conyuge', '$num_doc', 3)";
                if ($conn->query($e) === TRUE) {
                    $f="INSERT INTO vehiculo_venta(id_user, reg_vehiculo, fec_certi, clase, modelo, anio, tipo, 
                    color, placa, marca, uso, serial_carro, serial_motor, num_doc, id_sta)
                    VALUES($id_user, '$reg_veh', '$fec_cert', '$clase', '$modelo', $ano_veh, '$tipo', 
                    '$color', '$placa', '$marca', '$uso', '$serial_carro', '$serial_motor','$num_doc', 3)";
                        if ($conn->query($f) === TRUE) {
                            $g="INSERT INTO importe_venta(id_user, ciudad, estado, monto_usd, tasa, monto_bs, fecha, num_doc, id_sta)
                                VALUES($id_user, '$ciudad', '$estado', '$divisa', '$tasa', '$total_venta', '$fecha', '$num_doc', 3)";
                                if ($conn->query($g) === TRUE) {
                                    echo json_encode(array('status' => 'success', 'message' => 'Se guardaron los datos Correctamente, Por Favor haga el pago correspondiente para poder Imprimir el Documento'));
                                }else{
                                    echo json_encode(array('status' => 'error', 'message' => 'Error al Guardar el Documento: ' . $conn->error));
                                }
                    }else{
                        echo json_encode(array('status' => 'error', 'message' => 'Error al Guardar el Documento: ' . $conn->error));
                    }
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Error al Guardar el Documento: ' . $conn->error));
                }
        }else{
            echo json_encode(array('status' => 'error', 'message' => 'Error al Guardar el Documento: ' . $conn->error));
        }
}

?>