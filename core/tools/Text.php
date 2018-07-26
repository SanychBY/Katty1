<?php
/**
 * Created by PhpStorm.
 * User: ssaan
 * Date: 26.07.2018
 * Time: 11:21
 */

namespace core\tools;


use core\Element;

class Text extends Element
{
    private $text;

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

}