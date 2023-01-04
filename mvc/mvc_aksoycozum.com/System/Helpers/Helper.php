<?php

namespace System\Helpers;

class Helper
{
    public static function pr($param)
    {
        echo '</br><pre>';
        print_r($param);
        echo '</br></pre>';
    }

    public static function filter($val, $tag = false)
    {
        if($tag == false){
            $val = addslashes(strip_tags(trim($val)));
        }
        else{
            $val = addslashes(trim($val));
        }
        return $val;
    }
}
