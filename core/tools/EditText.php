<?php
namespace core\tools;


use core\Element;

class EditText extends Element
{
    public $type = 'input';
    public $text;
    public $placeholder;
    public function __construct()
    {
        parent::__construct();
        $this->viewElement = 'themes/toolsView/EditText';
    }
}