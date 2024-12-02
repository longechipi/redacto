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