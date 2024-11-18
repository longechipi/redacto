<?php 
require_once('conex.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $usuario = trim($_POST['usuario']);
    $pass = trim($_POST['clave']); 

function limpiarCorreo($user) {
    $user = trim($user);
    $user = filter_var($user, FILTER_SANITIZE_EMAIL);
    return $user;
}
    $user = limpiarCorreo($usuario);
    if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
        echo "El correo electrónico no es válido.";
        return;
    }else{
        $a="SELECT U.id_user, U.nombre, U.apellido, U.usuario, U.clave, US.id_sta, UP.id_pri 
        FROM users U 
        INNER JOIN users_status US ON U.id_user = US.id_user
        INNER JOIN users_privilegios UP ON U.id_user = UP.id_user
        WHERE U.usuario = '$user'";
        $ares= $conn->query($a);
        if ($ares->num_rows > 0){
            $row = $ares->fetch_assoc();
            $pass_hash = $row['clave'];
            if (password_verify($pass, $pass_hash)) {
                if (($row['id_sta'] == 1)){
                    $_SESSION['loggedin'] = true; // Usuario autenticado
                    $_SESSION['id_user'] = $row['id_user']; // ID del usuario
                    $_SESSION['id_sta'] = $row['id_sta']; // Estatus del Usuario
                    $_SESSION['id_pri'] = $row['id_pri']; // Privilegios del usuario
                    $_SESSION['usuario'] = $row['usuario']; // Usuario del Sistema
                    $_SESSION['nombre'] = $row['nombre'] .' '. $row['apellido']; // Nombre del Usuario
                    $_SESSION['start'] = time();
                    header('location: ../view/inicio');
                    exit;
                }elseif($row['id_sta'] == 2){
                    echo "Usuario Inactivo";
                
                }
            }else{
                echo "Contraseña incorrecta";
            }
        }else{
            echo "Usuario no encontrado";
        }
    }

}else{
    echo "No se recibieron datos del formulario";
}



?>