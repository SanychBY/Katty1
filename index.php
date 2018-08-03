<?php
require_once __DIR__.'/core/System.php';
$SYSTEM = new \core\System();
require_once "vendor/autoload.php";
$SYSTEM->autoloader();

if(isset($_GET['controller']))
{
    $controller = $_GET['controller'];
    if(!empty($controller) && $controller != 'Main'){
        $mapping = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/mapping.json'));
        $rf = false;
        foreach ($mapping->controllers as $k => $mc) {
            if($k == $controller){
                if(class_exists($mc)){
                    $obj = new $mc();
                    $obj->render();
                    $rf = true;
                }
                break;
            }
        }
        $class = $controller.'Controller';
        if(!$rf && class_exists($class)){
            $obj = new $class();
            $obj->render();
        }
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