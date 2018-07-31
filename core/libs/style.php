<?php
namespace core\libs;


function get_styles(){
    $arrStyles = [
        '/themes/'.\core\System::$SETTINGS->theme->path.'/style/css/AddReadMoreShowlesscontent.css',
        'https://fonts.googleapis.com/icon?family=Material+Icons',
        'https://code.getmdl.io/1.3.0/material.cyan-orange.min.css',
        ['https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css','integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"']
    ];
    $code = '';
    for($i = 0;$i < count($arrStyles); $i++){
        if(is_array($arrStyles[$i])){
            $code .= "<link href=\"{$arrStyles[$i][0]}\" rel=\"stylesheet\" {$arrStyles[$i][1]}>";
        }else {
            $code .= "<link href=\"{$arrStyles[$i]}\" rel=\"stylesheet\">";
        }
    }
    return $code;
}