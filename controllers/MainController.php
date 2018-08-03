<?php

namespace controllers;
use castom\themes\tools\blocks\MainPage\PromoBlock1;
use castom\themes\tools\blocks\MainPage\PromoBlock2;
use castom\themes\tools\MKHeader;
use castom\themes\tools\MKLogo;
use themes\pages\Main;

class MainController extends Controller
{

    public function render()
    {
        parent::render();
        $mainPage = new Main();
        $mainPage->title = "SHouseSystems - интеллектуальные домашние системы";

        $header = new MKHeader();
        $header->setLogo(new MKLogo());
        $mainPage->header[] = $header;
        $header->attr('class', 'navbar navbar-default');
        $block1 = new PromoBlock1();
        $mainPage->content[] = $block1;
        $mainPage->content[] = new PromoBlock2();
        $mainPage->render();
    }
}