<?php
namespace core\tools;


use core\Element;

class Button extends Element
{
    public $type;
    public $text;
    public function __construct($text = '')
    {
        parent::__construct();
        $this->text = $text;
    }
}