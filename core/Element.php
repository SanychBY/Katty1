<?php

namespace core;
include_once $_SERVER['DOCUMENT_ROOT'].'/models/model.php';
use models\Event;
use ReflectionObject;
use ReflectionProperty;

class Element implements \JsonSerializable
{
    protected $cache = false;
    protected $name = null;
    protected $onClick;
    public $attributes = [];
    public $viewElement = null;
    public $id;
    private $reflectionObject = null;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Element constructor.
     */
    public function __construct()
    {
        $this->name = get_class($this);
        $this->reflectionObject = new ReflectionObject($this);
        $this->loadElementJson();
    }

    /**
     * @return bool
     */
    public function isCache(): bool
    {
        return $this->cache;
    }

    /**
     * @param bool $cache
     */
    public function setCache(bool $cache)
    {
        $this->cache = $cache;
    }

    public function print_attributes(){
        foreach ($this->attributes as $attribute => $value){
            echo $attribute.'="'.$value.'" ';
        }
    }
    private function check_cache(){
        try {
            if ($this->cache) {
                $path = str_replace('\\', '/', get_class($this));
                $file = end(explode('\\',get_class($this)));
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/cache/' . $path.'/'.$file)) {
                    readfile($_SERVER['DOCUMENT_ROOT'] . '/cache/' . $path.'/'.$file);
                } else {
                    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/cache/' . $path.'/')) {
                        mkdir($_SERVER['DOCUMENT_ROOT'] . '/cache/' . $path.'/', 777, true);
                    }
                    ob_start();
                    $this->rendering();
                    $echo_data = ob_get_clean();
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/cache/' . $path . '/' . $file, $echo_data);
                    echo $echo_data;
                }
                return true;
            } else {
                return false;
            }
        }catch (\Exception $e){
            return false;
        }
    }
    private function rendering(){
        if($this->viewElement == null) {
            $f = null;
            $class_name = explode('\\', get_class($this));
            if (count($class_name) > 1) {
                $class_name = $class_name[count($class_name) - 1];
            }
            if(file_exists( $_SERVER['DOCUMENT_ROOT'] . '/themes/toolsView/' . $class_name . '.php')){
                include_once $_SERVER['DOCUMENT_ROOT'] . '/themes/toolsView/' . $class_name . '.php';
                $f = 'themes_toolsView_' . $class_name . '_get_html';
            }elseif (file_exists( $_SERVER['DOCUMENT_ROOT'] . '/themes/'.System::$SETTINGS->theme->path.'/toolsView/' . $class_name . '.php')){
                include_once $_SERVER['DOCUMENT_ROOT'] . '/themes/'.System::$SETTINGS->theme->path.'/toolsView/' . $class_name . '.php';
                $f = 'themes_'.System::$SETTINGS->theme->path.'_toolsView_'.$class_name.'_get_html';
            }elseif(file_exists( $_SERVER['DOCUMENT_ROOT'] . '/castom/themes/'.System::$SETTINGS->theme->path.'/toolsView/' . $class_name . '.php')){
                include_once $_SERVER['DOCUMENT_ROOT'] . '/castom/themes/'.System::$SETTINGS->theme->path.'/toolsView/' . $class_name . '.php';
                $f = 'castom_themes_'.System::$SETTINGS->theme->path.'_toolsView_'.$class_name.'_get_html';
            }else{
                throw new \Exception("can not load view for element \"{$class_name}\"");
            }
            if(function_exists($f))
                $f($this);
            else{
                throw new \Exception('function "'.$f.'" not exists');
            }
        }else{
            if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/'. $this->viewElement.'.php')) {
                include_once $_SERVER['DOCUMENT_ROOT'] . '/'. $this->viewElement.'.php';
                $f = implode('_', explode('/', $this->viewElement)) . '_get_html';
                if (function_exists($f))
                    $f($this);
                else {
                    echo 'error';
                    echo $f;
                }
            }
        }
    }
    public function render(){
        if(!$this->check_cache()){
            $this->rendering();
        }
    }

    protected function trace_arr_for_load_json($arr){
        foreach ($arr as &$el){
            if (is_array($el))
                $this->trace_arr_for_load_json($el);
            elseif(is_object($el) && class_exists($el->name)){
                $nameClass = $el->name;
                $this->objectToObject($el, new $nameClass());
            }
        }
    }
    protected function objectToObject($objValues, $_class)
    {
        foreach($objValues AS $key=>$value)
        {
            if(is_object($value) && class_exists($value->name)){
                $nameClass = $value->name;
                $this->objectToObject($value, new $nameClass);
            }
            if(is_array($value)){
                $this->trace_arr_for_load_json($value);
            }
            if($this->checkPropertyAccess($key)) {
                $this->$key = $value;
            }else{
                $setter = 'set'.ucfirst($key);
                if(method_exists($_class,$setter)){
                    $_class->$setter($value);
                }
            }
        }
    }
    public function loadElementJson($link = null){
        if($link == null){
            $path = str_replace('\\', '/', get_class($this));
            $file = end(explode('\\',get_class($this)));
            $link = $_SERVER['DOCUMENT_ROOT'].'/themes/'.System::$SETTINGS->theme->path.'/viewsJson/'.$path.'/'.$file.'.json';
        }else{
            $link = $_SERVER['DOCUMENT_ROOT'].'/'.$link.'.json';
        }
        if(file_exists($link) && $json = file_get_contents($link)){
            $objValues = get_object_vars(json_decode($json)); // return array of object values
            foreach($objValues AS $key=>$value)
            {
                if(is_object($value) && class_exists($value->name)){
                    $nameClass = $value->name;
                    $this->objectToObject($value, new $nameClass);
                }
                else{
                    echo $key.'<br>';

                }
                if(is_array($value)){
                    $this->trace_arr_for_load_json($value);
                }
                if($this->checkPropertyAccess($key)) {
                    $this->$key = $value;
                }else{
                    $setter = 'set'.ucfirst($key);
                    if($this->reflectionObject->hasMethod($setter)){
                        $this->$setter($value);
                    }
                }
            }
        }
    }
    private function checkPropertyAccess($prop){
        $testClassProperties = $this->reflectionObject->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($testClassProperties as $key => $property){
            if(strcmp($property->name, $prop) == 0){
                unset($testClassProperties[$key]);
                return true;
            }
        }
        return false;
    }
    /**
     * @param Event $onClick
     */
    public function setOnClick($onClick)
    {
        $this->onClick = $onClick;
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
        $json = array();
        $testClassPropertiesAll = $this->reflectionObject->getProperties();
        foreach($testClassPropertiesAll as $property) {
            $vl = $property->name;
            if($this->checkPropertyAccess($vl)){
                $json[$property->name] = $this->$vl;
            }else{
                $getter = 'get'.ucfirst($vl);
                $iser = 'is'.ucfirst($vl);
                if($this->reflectionObject->hasMethod($getter)){
                    $json[$property->name] = $this->$getter();
                }elseif ($this->reflectionObject->hasMethod($iser)){
                    $json[$property->name] = $this->$iser();
                }
            }
        }
        return $json;
    }
}