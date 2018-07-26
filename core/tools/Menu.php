<?php

namespace core\tools;


use core\Element;
use models\ElementList;

class Menu extends Element
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

    public function print_elements()
    {
        $this->trace_arr($this->elements->toArray());
    }

    private function trace_arr($arr)
    {
        foreach ($arr as $el) {
            if (is_array($el))
                $this->trace_arr($el);
            elseif (method_exists($el, 'render')) {
                $el->render();
            }
        }
    }
}