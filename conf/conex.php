<?php
$servidor = "localhost";
$usuario = "root";
$password = "12345";
$base_datos = "redacto";

$conn = new mysqli($servidor, $usuario, $password, $base_datos);
if ($conn->connect_error) {
    die("Problemas con la Base de Dato");
}
?>