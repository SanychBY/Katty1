<?php
/**
 * Created by PhpStorm.
 * User: ssaan
 * Date: 08.08.2018
 * Time: 17:25
 */

namespace castom\themes\tools\blocks\MainPage;


use core\Element;

class PromoBlock3 extends Element
{
    public function __construct()
    {
        parent::__construct();
        $this->viewElement = 'castom/themes/toolsViews/blocks/MainPage/PromoBlock3';
    }
}