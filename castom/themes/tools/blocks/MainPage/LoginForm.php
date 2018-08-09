<?php
/**
 * Created by PhpStorm.
 * User: ssaan
 * Date: 08.08.2018
 * Time: 17:37
 */

namespace castom\themes\tools\blocks\MainPage;


use core\tools\Form;
use models\Event;
use themes\MaterialKatty\tools\MKButton;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        $this->id = 'login_form_send_data';
        $login = new MKLoginEditText();
        $login->attr('placeholder', 'логин или email');
        $login->attr('name', 'nick');
        $password = new MKLoginEditText('пароль');
        $password->attr('placeholder', 'пароль');
        $password->attr('type', 'password');
        $password->attr('name', 'password');
        $sb = new MKButton('Войти');
        $this->setElements([$login, $password, $sb]);
        $this->setSubmitButton($sb);
        $event = new Event();
        $event->setSuccess('castom/themes/toolsJS/Form/SuccessSendFormData');
        $this->setSubmitEvent($event);
    }
}