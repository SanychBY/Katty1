<?php
/**
 * Created by PhpStorm.
 * User: ssaan
 * Date: 18.07.2018
 * Time: 14:01
 */

namespace themes\MaterialKatty\tools;


use core\tools\Button;

class MKButton extends Button
{
    public function __construct($text = '')
    {
        parent::__construct($text);
        $this->viewElement = 'themes/toolsView/Button';
        $this->attributes['class'] = 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent';
    }
}