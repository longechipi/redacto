<?php 
$curl = curl_init("https://www.bcv.org.ve/");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$page = curl_exec($curl);
if (curl_errno($curl)) {
    echo 'Error del scraper: ' . curl_error($curl);
    exit;
}
curl_close($curl);
$regex = '/<strong>(.*?)<\/strong>/';
$matches = preg_match_all($regex, $page, $list);
if ($matches > 0) {
    $list = array_reverse($list);
    $res = $list[0][6];
    trim($res);
    $res = str_replace(",", ".", $res);
    $servername = "localhost";
    $username = "root_autogas";
    $password = "19341986Chipi**";
    $dbname = "autogas";

$conn = new mysqli($servidor, $usuario, $password, $base_datos);
if ($conn->connect_error) {
    die("Problemas con la Base de Dato");
}
$a="INSERT INTO tasa(moneda, fecha, valor)VALUES('USD', CURDATE(), '$res')";
if($conn->query($a)===TRUE){
    $res = "1";
    // /usr/local/bin/php /home/wgdigit1/app.wgdigital.com.ve/utils/bcv.php CAMBIAR POR LA RUTA CORRECTA DEL SERVIDOR
}
}else{
    echo "error";

}
$conn->close();
?>