<?php

namespace controllers;
use castom\themes\tools\MKHeader;
use castom\themes\tools\MKLogo;
use core\System;
use core\tools\Button;
use core\tools\EditText;
use core\tools\Form;
use models\Event;
use ReflectionObject;
use ReflectionProperty;
use themes\MaterialKatty\tools\MKButton;
use themes\MaterialKatty\tools\MKEditText;
use themes\pages\Main;

class MainController extends Controller
{

    public function render()
    {
        parent::render();
        $mainPage = new Main();
        $mainPage->title = "MainPage";
        $et2 = new MKEditText();
        $et2->placeholder = 'text';

        $b2 =  new MKButton("Click 3");
        $regForm = new Form();
        $regForm->id = 'testForm';
        $ev = new Event();
        $regForm->setSubmitButton($b2);
        $ev->setSuccess('castom/themes/toolsJS/Form/SuccessSendFormData');
        $regForm->setSubmitEvent($ev);
        $regForm->getElements()->add($et2);
        $regForm->getElements()->add($b2);


        $mainPage->content[] = $regForm;

        $header = new MKHeader();
        $header->setLogo(new MKLogo());
        $mainPage->header[] = $header;
        $header->attr('class', 'navbar navbar-default');
        $mainPage->render();
    }
}