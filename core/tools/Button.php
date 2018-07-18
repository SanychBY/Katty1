<?php
namespace core\tools;


use core\Element;

class Button extends Element
{
    public $type;
    public $text;
    public $onClick;
    public function __construct($text = '')
    {
        $this->text = $text;
    }
}