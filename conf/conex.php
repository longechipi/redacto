<?php
$servidor = "66.85.132.90";
$usuario = "root_autogas";
$password = "19341986Chipi**";
$base_datos = "redacto";

$conn = new mysqli($servidor, $usuario, $password, $base_datos);
if ($conn->connect_error) {
    die("Problemas con la Base de Dato");
}
?>