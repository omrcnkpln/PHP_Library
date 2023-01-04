<?php
namespace OMRCNKPLN;

class Helper
{
    public static function load(){
        $helperDir = realpath(".") . "/app/Helpers";

        if ($dh = opendir($helperDir)) {
            while ($file = readdir($dh)) {
                if (is_file($helperDir . "/" . $file)){
                    require $helperDir . "/" . $file;
                }
            }
        }
    }
}