<?php
require_once 'core/System.php';
$SYSTEM = new \core\System();
require_once "vendor/autoload.php";
$SYSTEM->autoloader();

if(isset($_GET['controller']))
{
    $controller = $_GET['controller'];
    if(!empty($controller) && $controller != 'Main'){

    }else{
        $class = '\controllers\MainController';
        $obj = new $class();
        $obj->render();
    }
}
elseif (empty($_GET['controller'])){
    $class = '\controllers\MainController';
    $obj = new $class();
    $obj->render();
}