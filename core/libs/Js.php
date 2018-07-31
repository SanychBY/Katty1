<?php
namespace core\libs;

use core\System;

class Js
{
    public $arrStyles = [];
    public function __construct()
    {
        $this->arrStyles = [
            'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js',
            '/themes/' . \core\System::$SETTINGS->theme->path . '/js/AddReadMore.js',
            'https://code.getmdl.io/1.3.0/material.min.js',
            ['https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', "integrity=\"sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49\" crossorigin=\"anonymous\""],
            ['https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', "integrity=\"sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy\" crossorigin=\"anonymous\""]
        ];
        $this->arrStyles = array_merge($this->arrStyles, System::$GENERAL_JS );
    }

    public function get_js()
    {
        $code = '';
        for ($i = 0; $i < count($this->arrStyles); $i++) {
            if(is_array($this->arrStyles[$i])){
                $code .= "<script src=\"{$this->arrStyles[$i][0]}\" {$this->arrStyles[$i][1]}></script>";
            }else {
                $code .= "<script src=\"{$this->arrStyles[$i]}\"></script>";
            }
        }
        return $code;
    }
}