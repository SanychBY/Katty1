<?php

namespace castom\themes\tools;


use core\Element;

class MKLogo extends Element
{
    public function __construct()
    {
        parent::__construct();
        $this->viewElement = 'castom/themes/toolsViews/MKLogo';
    }
}