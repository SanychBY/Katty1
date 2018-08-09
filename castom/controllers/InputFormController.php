<?php

namespace castom\controllers;


use castom\themes\tools\blocks\MainPage\LoginForm;
use castom\themes\tools\MKHeader;
use castom\themes\tools\MKLogo;
use controllers\Controller;
use themes\pages\Main;

class InputFormController extends Controller
{
    public function render()
    {
        parent::render();
        $mainPage = new Main();
        $mainPage->title = "SHouseSystems - интеллектуальные домашние системы";

        $header = new MKHeader();
        $header->setLogo(new MKLogo());
        $mainPage->header[] = $header;
        $mainPage->content[] = new LoginForm();
        $mainPage->render();
    }
}