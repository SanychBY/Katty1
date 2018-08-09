<?php


namespace castom\controllers;


use castom\controllers\RestApi\Functions;
use castom\controllers\RestApi\RestAnswer;
use controllers\Controller;

class RestApiController extends Controller
{
    public function render()
    {
        parent::render();
        if(isset($_GET['func'])){
            $f = $_GET['func'];
            switch ($f){
                case 'get_users':{
                    echo json_encode(Functions::get_users($_GET['params']));
                    break;
                }
                default:{
                    $answer = new RestAnswer();
                    $answer->message = 'function not found';
                    $answer->status = '404';
                    echo json_encode($answer);
                }
            }
        }
    }
}