<?php

namespace models;
include_once $_SERVER['DOCUMENT_ROOT'].'/models/model.php';

use core\Element;

class ElementList implements \JsonSerializable
{
    private $elements = [];

    /**
     * @param $id
     * @return \stdClass
     */
    public function getElementById($id){
        return $this->trace_arr($this->elements,$id);
    }

    /**
     * @param $arr
     * @param $id
     * @return \stdClass
     */
    private function trace_arr($arr, &$id){
        foreach ($arr as $el){
            if (is_array($el))
                $this->trace_arr($el, $id);
            else
                if($el->id == $id){
                    return $el;
                }
        }
        return null;
    }

    /**
     * @param $i
     * @return \stdClass
     */
    public function get($i){
        return $this->elements[$i];
    }


    public function add($e){
        $this->elements[] = $e;
    }

    public function toArray(){
        return $this->elements;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        return $this->toArray();
    }
}