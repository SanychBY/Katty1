<?php

namespace themes\MaterialKatty\tools;


use core\tools\EditText;

class MKEditText extends EditText
{
    public function __construct()
    {
        parent::__construct();
        $this->attributes['class'] = 'mdl-textfield mdl-js-textfield is-upgraded';
    }
}