<?php
/**
 * Copyright (c) 2014 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.0
 */

/** This class contains some json fix static functions */

class Json {

    static function jsonSafe($data, $header){
        if(strstr($header, "windows"))
            return json_encode(Json::jsonFix($data));
        else
            return json_encode($data);
    }

    static function jsonFix($data){
        if(is_array($data))    {
            $new = array();
            foreach ($data as $k => $v)
            {
                $new[Json::jsonFix($k)] = Json::jsonFix($v);
            }
            $data = $new;
        }
        else if(is_object($data)){
            $datas = get_object_vars($data);
            foreach ($datas as $m => $v)
            {
                $data->$m = Json::jsonFix($v);
            }
        }
        else if(is_string($data)){
            $data = iconv('cp1251', 'utf-8', $data);
        }
        return $data;
    }
}
