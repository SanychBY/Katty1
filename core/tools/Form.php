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
    private $submitEvent;

    /**
     * @return mixed
     */
    public function getSubmitEvent()
    {
        return $this->submitEvent;
    }

    /**
     * @param mixed $submitEvent
     */
    public function setSubmitEvent($submitEvent)
    {
        $this->submitEvent = $submitEvent;
    }
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
        System::ADD_GENERAL_JS('/themes/toolsJs/Form/NotSendForm.js');
        $this->viewElement = 'themes/toolsView/Form';
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

    public function render()
    {
        if(isset($this->submitEvent)) {
            $s = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/' . $this->submitEvent->getSuccess() . '.js');
            include_once($_SERVER['DOCUMENT_ROOT'] . '/themes/toolsJS/Form/FormSendData.php');
            $this->submitButton->attributes['onClick'] = FormSendData_get_js($this->id, 'castom/Form', $s);
        }
        parent::render();
    }

}