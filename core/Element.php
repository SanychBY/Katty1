<?php

namespace core;
class Element
{
    public $cache = true;
    public $attributes = [];
    public $viewElement = null;
    public function print_attributes(){
        foreach ($this->attributes as $attribute => $value){
            echo $attribute.'="'.$value.'" ';
        }
    }
    public function render(){
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
                $f = 'themes_'.System::$SETTINGS->theme->path.'_toolsView_'.$class_name.'_get_html';
            }if(file_exists( $_SERVER['DOCUMENT_ROOT'] . '/castom/themes/'.System::$SETTINGS->theme->path.'/toolsView/' . $class_name . '.php')){
                $f = 'castom_themes_'.System::$SETTINGS->theme->path.'_toolsView_'.$class_name.'_get_html';
            }
            if(function_exists($f))
                $f($this);
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
}