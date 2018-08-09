<?php


namespace castom\themes\tools\blocks\MainPage;


use core\tools\EditText;

class MKLoginEditText extends EditText
{
    public function __construct($text = '')
    {
        parent::__construct();
        $this->attr('class',$this->attr('class').' form-control');
    }
}