<?php

namespace core\tools;


use core\Element;

class Form extends Element
{
    public $elements = [];
    public $submit_button;
    public function print_elements()
    {
        $this->trace_arr($this->elements);
    }

    private function trace_arr($arr){
        foreach ($arr as $el){
            if (is_array($el))
                $this->trace_arr($el);
            else
                $el->render();
        }
    }
}