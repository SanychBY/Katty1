<?php
/**
 * Created by PhpStorm.
 * User: ssaan
 * Date: 01.08.2018
 * Time: 10:41
 */

namespace controllers;


use core\libs\Imagegenerator;

class ImageController extends Controller
{
    public function render()
    {
       $ImageGenerator = new Imagegenerator();
       $ImageGenerator->generate();
    }

}