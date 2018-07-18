<?php
/**
 * Created by PhpStorm.
 * User: ssaan
 * Date: 18.07.2018
 * Time: 14:01
 */

namespace themes\NiceKatty\tools;


use core\tools\Button;

class MKButton extends Button
{
    public $attributes = [
        'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent'
    ];
    public $viewElement = 'themes/toolsView/Button';
}