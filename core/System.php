<?php

namespace core;

use Exception;


class System
{
    public static $SETTINGS = null;
    public static $GENERAL_JS = [];

    public static function ADD_GENERAL_JS($l){
        foreach (System::$GENERAL_JS as $GENERAL_J)
        {
            if($GENERAL_J == $l){
                return;
            }
        }
        System::$GENERAL_JS[] = $l;
    }

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
    public static $first_autload = [
        'core/Element',
        'models/Model',
        'controllers/Controller'
    ];

    public static function autoloader(){
        foreach (System::$first_autload as $item) {
            $file = $_SERVER['DOCUMENT_ROOT'] . '/'.$item.'.php';
            if(file_exists($file)) {
                echo $file.'<br>';
                include_once $file;
            }
        }
        foreach (System::$roots_autload as $roots){
            System::recfileloader($_SERVER['DOCUMENT_ROOT'] . '/' . $roots);
        }
    }

    private static function recfileloader($root){
        if(file_exists($root)) {
            $scn = scandir($root, SCANDIR_SORT_NONE);
            foreach ($scn as $path) {
                if ($path == '.' || $path == '..')
                    continue;
                if (is_dir($root . '/' . $path)) {
                    System::recfileloader($root . '/' . $path);
                } elseif (mb_strlen($path) >= 4 && mb_strimwidth($path, mb_strlen($path) - 4, 4) == '.php') {
                    require_once($root . '/' . $path);
                }
            }
        }
    }

    public static function array_trim($arr, $save_key = false){
        foreach ($arr as $key => $value){
            if(empty($value)){
                if($save_key){
                    unset($arr[$key]);
                }else{
                    array_splice($arr,$key,1);
                }
            }
        }
        return $arr;
    }

    public static function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir."/".$object))
                        System::rrmdir($dir."/".$object);
                    else
                        unlink($dir."/".$object);
                }
            }
            rmdir($dir);
        }
    }

}