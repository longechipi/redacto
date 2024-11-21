<?php 
//------ VALIDACION DE POST ------//
function validar_post($id, $pagina_error) {
    if (empty($id) || !is_numeric($id)) {
        header('Location: ' . $pagina_error);
        exit;
    }
}