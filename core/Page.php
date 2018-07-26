<?php
namespace core;

use function core\libs\get_js;
use function core\libs\get_styles;
use core\libs\Js;

class Page
{
    public $title = '';
    public $meta = '';
    public $styles = '';
    public $scripts = '';
    public $footer = '';
    public $header = [];
    public $content = [];
    public $uri = '';

    public function render(){
        $js = new Js();
        $this->scripts = $js->get_js().$this->scripts;
        $this->styles = get_styles().$this->styles;
        $class_name = explode('\\', get_class($this));
        if(count($class_name) > 1){
            $class_name = $class_name[count($class_name) - 1 ];
        }
        include_once $_SERVER['DOCUMENT_ROOT'].'/themes/views/'.$class_name.'.php';
        $f = 'themes_views_'.$class_name.'_get_html';
        $f($this);
    }

    public function get_content(){
        $this->trace_arr($this->content);
    }

    private function trace_arr($arr){
        foreach ($arr as $el){
            if (is_array($el))
                $this->trace_arr($el);
            else
                $el->render();
        }
    }

    public function get_header(){
        $this->trace_arr($this->header);
    }
}