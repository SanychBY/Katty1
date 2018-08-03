<?php
/**
 * Created by PhpStorm.
 * User: ssaan
 * Date: 03.08.2018
 * Time: 15:28
 */
namespace castom\themes\tools\blocks\MainPage;
use core\Element;

class PromoBlock1 extends Element
{
    public function __construct()
    {
        parent::__construct();
        $this->viewElement = 'castom/themes/toolsViews/blocks/MainPage/PromoBlock1';
    }
}