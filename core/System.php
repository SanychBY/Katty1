<?php

namespace core;

use Exception;


class System
{
    public static $SETTINGS = null;

    public static function load_settings(){
        if(System::$SETTINGS = file_get_contents('kconfig.json')){
            try{
                System::$SETTINGS = json_decode(System::$SETTINGS);

            }catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }else{
            echo 'er';
        }
    }

    public static $roots_autload = [
        'core',
        'models',
        'services',
        'themes',
        'controllers',
        'castom'
    ];

    public static function autoloader(){
        foreach (System::$roots_autload as $roots){
            System::recfileloader($_SERVER['DOCUMENT_ROOT'].'/'.$roots);
        }
    }

    private static function recfileloader($root){
        $scn = scandir($root,SCANDIR_SORT_NONE);
        foreach ($scn as $path) {
            if($path == '.' || $path == '..')
                continue;
            if(is_dir($root.'/'.$path)){
                System::recfileloader($root.'/'.$path);
            }elseif(mb_strlen($path) >= 4 && mb_strimwidth($path, mb_strlen($path) - 4, 4) == '.php'){
                require_once($root.'/'.$path);
            }
        }
    }
}