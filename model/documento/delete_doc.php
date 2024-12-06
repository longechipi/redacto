<?php 
require_once('../../conf/conex.php');
require_once('../../utils/utils.php');
$id_doc = $_POST['id_doc'];

try {
    $conn->begin_transaction();
    //------ ELIMINAMOS DOCUMENTO TEMPORAL ------//
    $a="DELETE FROM documentos_tmp WHERE num_doc = '$id_doc' AND id_sta = 3";
    $ares= $conn->query($a);

    //------ ELIMINAMOS IMPORTE DE VENTA ------//
    $b="DELETE FROM importe_venta WHERE num_doc = '$id_doc' AND id_sta = 3";
    $bres= $conn->query($b);

    //------ ELIMINAMOS IMPORTE DE VENTA ------//
    $c="DELETE FROM vehiculo_venta WHERE num_doc = '$id_doc' AND id_sta = 3";
    $cres= $conn->query($c);

    //----- BUSCAMOS EN LAS TABLAS DE DATOS ------//
    $d="SELECT PN.num_doc AS p_natural, PJ.num_doc AS p_juridico, PS.num_doc AS p_sucesion
        FROM per_natural PN
        LEFT JOIN per_juridico PJ ON PN.num_doc =  PJ.num_doc
        LEFT JOIN per_sucesion PS ON PN.num_doc = PS.num_doc
        WHERE PN.num_doc = '$id_doc'";
    $dres = $conn->query($d);

    if ($dres->num_rows > 0) {
        while($row = $dres->fetch_assoc()) {
            // Eliminar de per_natural
            if ($row['p_natural']) {
                $e = "DELETE FROM per_natural WHERE num_doc = '$id_doc'";
                $eres = $conn->query($e);
            }
            // Eliminar de per_juridico
            if ($row['p_juridico']) {
                $f = "DELETE FROM per_juridico WHERE num_doc = '$id_doc'";
                $fres = $conn->query($f);
            }
            // Eliminar de per_sucesion
            if ($row['p_sucesion']) {
                $g = "DELETE FROM per_sucesion WHERE num_doc = '$id_doc'";
                $gres = $conn->query($g);
            }
        }
    }
    if ($conn->commit()) {
        echo resjson(true, null, null, 'Se elimino Correctamente el Documento '.$id_doc.'');
    } else {
        $conn->rollback();
        echo resjson(false, null, 'Error al eliminar el Documento '.$id_doc.''); 
    }
}catch (mysqli_sql_exception $e) {
    echo resjson(false, null, 'Error en la Base de Datos para eliminar el Documento');
} finally {
    $conn->close();
}
