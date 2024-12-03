<?php 
//------ VALIDACION DE POST con ID numerico------//
function validar_post($id, $pagina_error) {
    if (empty($id) || !is_numeric($id)) {
        header('Location: ' . $pagina_error);
        exit;
    }
}
//------ VALIDACION DE POST con ID Varchar------//
function validar_post_char($id, $pagina_error) {
    if (empty($id)) {
        header('Location: ' . $pagina_error);
        exit;
    }
}
//------ VALIDAR CORREO  ------//
function limpiarCorreo($usuario) {
    $usuario = trim($usuario);
    $usuario = filter_var($usuario, FILTER_SANITIZE_EMAIL);
    return $usuario;
}

//------ LIMPIAR CADENA ------ //
function limpiarCadena($cadena) {
    $cadena = trim($cadena);
    $cadena = strip_tags($cadena);
    $cadena = preg_replace('/[^a-zA-Z0-9\s]/', '', $cadena);
    return $cadena;
}

//------ MANEJA RESPUESTAS EN JSON ------//
function resjson($success, $data = null, $error_message = null, $success_message = null) {
    $response = new stdClass();
    $response->success = $success;
        if ($success) {
            $response->data = $data;
            $response->message = $success_message; // Agregamos el mensaje de éxito
        } else {
            $response->error = [
                'message' => $error_message,
            ];
        }
    return json_encode($response);
}