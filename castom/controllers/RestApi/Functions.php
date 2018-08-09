<?php

namespace castom\controllers\RestApi;


use core\DB;

class Functions
{

    public static function get_users($params){
        $fields = DB::get_fields_names('users');
        $lim = null;
        if(isset($params['page'])){
            $page = $params['page'];
            $lim = ($page - 1) * 1000;
            $lim .= ', 1000';
        }
        if(!empty($params)){
            $params = self::check_params_fields($fields, $params);
        }
        $answer = new RestAnswer();
        try {
            $answer->message = 'ok';
            $answer->status = '200';
            $answer->data = DB::request('users', $params, null, 'and', null, $lim);
            return $answer;
        }catch (\Exception $exception){
            $answer->message = $exception->getMessage();
            $answer->status = '500';
            return $answer;
        }
    }
    private static function check_params_fields($fieldnames, $params){
        $resarr = [];
        foreach ($fieldnames as $fieldname){
            foreach ($params as $key => $value){
                if($fieldname == $key){
                    $resarr[$key] = $value;
                }
            }
        }
        return $resarr;
    }

}