<header>
    <link rel="stylesheet" type="text/css" href="../../src/plugins/sweetalert2/sweetalert2.css">
    <script src="../../src/plugins/sweetalert2/sweetalert2.all.js"></script>
</header>
<?php
require('../../conf/conex.php');
require('../../utils/utils.php');
define("RECAPTCHA_V3_SECRET_KEY", '6LfC_4gqAAAAANVt8ZaII_KyOwXdJrynx4iFQIej');
$token = $_POST['token'];
$action = $_POST['action'];
 
// call curl to POST request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$arrResponse = json_decode($response, true);
 
if($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.6) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //---- DATOS DEL FORMULARIO ----//
        $usuario = limpiarCorreo(trim($_POST["usuario"]));
        $nombre = limpiarCadena(trim($_POST["nombre"]));
        $apellido = limpiarCadena(trim($_POST["apellido"]));
        $telf_error = filter_var(trim($_POST['telf']), FILTER_SANITIZE_NUMBER_INT);
        $telf = preg_replace('/[^0-9]/', '', $telf_error);
        $email = limpiarCorreo(trim($_POST["mail"]));
        $pass = password_hash(trim($_POST['pass']), PASSWORD_DEFAULT);

        $a="SELECT usuario FROM users WHERE usuario = '$usuario' OR correo ='$email'";
        $ares= $conn->query($a);
            if($ares->num_rows > 0){
                echo '<script>
                    swal({
                        type: "error",
                        title: "Error",
                        text: "¡El Usuario y/o el Correo Alterno existen en nuestra Plataformar!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){                   
                            window.location = "../../register.html";
                            }
                        });
                    </script>';
                exit;
            }else{
                //---- INSERT EN LA TABLA DE USUARIO ----//
                $b = "INSERT INTO users(nombre, apellido, usuario, correo, telefono, clave)
                VALUES('$nombre', '$apellido', '$usuario', '$email', '$telf', '$pass')";
                if ($conn->query($b) === TRUE) {
                    //---- INSERT EN LA TABLA DE USUARIO ESTATUS ----//
                    $id_user = mysqli_insert_id($conn);
                    //---- Preguntar ----//
                    $c="INSERT INTO users_status(id_user, id_sta)VALUES($id_user, 1)";
                    if ($conn->query($c) === TRUE) {
                         //---- INSERT EN LA TABLA DE USUARIO PRIVILEGIOS ----//
                        $d="INSERT INTO users_privilegios(id_user, id_pri)VALUES($id_user, 4)";
                            if ($conn->query($d) === TRUE) {
                                echo '<script>
                                swal({
                                    type: "success",
                                    title: "Exito",
                                    text: "¡Felicidades el usuario se registro correctamente!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                    }).then(function(result){
                                        if(result.value){                   
                                        window.location = "../../index.html";
                                        }
                                    });
                                </script>';
                            }else{
                                echo '<script>
                                        swal({
                                            type: "error",
                                            title: "Error",
                                            text: "¡Error al Registrar el usuario !",
                                            showConfirmButton: true,
                                            confirmButtonText: "Cerrar"
                                            }).then(function(result){
                                                if(result.value){                   
                                                window.location = "../../register.html";
                                                }
                                            });
                                        </script>';
                                    }
                    }else{
                        echo '<script>
                        swal({
                            type: "error",
                            title: "Error",
                            text: "¡Error al Registrar el usuario !",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if(result.value){                   
                                window.location = "../../register.html";
                                }
                            });
                        </script>';
                    }
                }else{
                    echo '<script>
                        swal({
                            type: "error",
                            title: "Error",
                            text: "¡Error al Registrar el usuario !",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if(result.value){                   
                                window.location = "../../register.html";
                                }
                            });
                        </script>';
                }
            }
    }else{
        echo '<script>
            swal({
                type: "error",
                title: "Error",
                text: "¡Error al Registrar el usuario !",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if(result.value){                   
                    window.location = "../../register.html";
                    }
                });
            </script>';
    }
 } 
 //else {
//     // Si entra aqui, es un robot....
// 	echo "Lo siento, parece que eres un Robot";
// }