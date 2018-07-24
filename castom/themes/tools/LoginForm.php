<?php

namespace castome\themes\tools;
use core\tools\Form;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        $this->loadElementJson('castom/themes/viewsJson/loginForm/loginForm');
        $this->viewElement = 'themes/toolsView/Form';
    }
}