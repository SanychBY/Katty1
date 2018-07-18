<?php
namespace core\libs;

function get_js(){

    $arrStyles = [
        'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js',
        '/themes/'.\core\System::$SETTINGS->theme->path.'/js/AddReadMore.js',
        'https://code.getmdl.io/1.3.0/material.min.js'
        ];


    $code = '';
    for($i = 0;$i < count($arrStyles); $i++){
        $code .= "<script src=\"{$arrStyles[$i]}\"></script>";
    }
    return $code;
}