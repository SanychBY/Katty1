<?php

namespace castom\themes\tools;
use core\tools\Menu;
use models\ElementList;


class MKHeader extends \core\Element
{
    private $elements;
    private $logo;
    private $menu;
    /**
     * @return MKLogo
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param MKLogo $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

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

    public function __construct()
    {
        parent::__construct();
        $this->viewElement = 'castom/themes/toolsViews/MKHeader';
        $this->attr('class', 'navbar navbar-default');
    }

    /**
     * @return Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param Menu $menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    }
}