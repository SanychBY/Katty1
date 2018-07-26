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
            'https://code.getmdl.io/1.3.0/material.min.js'
        ];
        $this->arrStyles = array_merge($this->arrStyles, System::$GENERAL_JS );
    }

    public function get_js()
    {
        $code = '';
        for ($i = 0; $i < count($this->arrStyles); $i++) {
            $code .= "<script src=\"{$this->arrStyles[$i]}\"></script>";
        }
        return $code;
    }
}