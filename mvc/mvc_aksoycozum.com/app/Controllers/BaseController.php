<?php

namespace app\Controllers;

use System\Helpers\Helper;

class BaseController
{
    public static function View($page)
    {
        $folder = $page[0];
        $view = $page[1];
        $request = $_SERVER["REQUEST_METHOD"];

        if ($request == "GET") {
            $view .= "View";
        }else{
            $view .= "Post";
        }

        if (file_exists(VIEWS . $folder . "/" . $view . ".php")) {
            require VIEWS . $folder . "/" . $view . ".php";
        }

        return false;
    }
}