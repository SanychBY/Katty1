<?php
namespace core\libs;


function get_styles(){
    $arrStyles = [
        '/themes/'.\core\System::$SETTINGS->theme->path.'/style/css/AddReadMoreShowlesscontent.css',
        'https://fonts.googleapis.com/icon?family=Material+Icons',
        'https://code.getmdl.io/1.3.0/material.cyan-orange.min.css'];

    $code = '';
    for($i = 0;$i < count($arrStyles); $i++){
        $code .= "<link href=\"{$arrStyles[$i]}\" rel=\"stylesheet\">";
    }
    return $code;
}