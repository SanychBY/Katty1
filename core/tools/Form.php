<?php

namespace core\tools;


use core\Element;
use core\System;
use models\ElementList;

class Form extends Element
{
    private $elements;

    /**
     * @return ElementList
     */
    public function getElements(): ElementList
    {
        return $this->elements;
    }

    /**
     * @param array $elements
     */
    public function setElements($elements)
    {
        foreach ($elements as $element){
            $this->elements->add($element);
        }
    }

    private $submitButton;

    /**
     * @return Button
     */
    public function getSubmitButton()
    {
        return $this->submitButton;
    }

    /**
     * @param Button $submit_button
     */
    public function setSubmitButton($submit_button)
    {
        $this->submitButton = $submit_button;
    }
    public function __construct()
    {
        parent::__construct();
        $this->elements = new ElementList();
    }

    public function print_elements()
    {
        $this->trace_arr($this->elements->toArray());
    }

    private function trace_arr($arr){
        foreach ($arr as $el){
            if (is_array($el))
                $this->trace_arr($el);
            elseif(method_exists($el, 'render')){
                $el->render();
            }
        }
    }

}