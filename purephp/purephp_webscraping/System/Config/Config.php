<?php

namespace System\Config;

class Config
{
    public static function Configure()
    {
        //projenin çalıştığı dizin belirlendi route yapılandırma için gerekli
        $dirname = strtolower(dirname($_SERVER["SCRIPT_NAME"]));

        $dirname = ltrim($dirname, "/");
        $basename = strtolower(basename($_SERVER["SCRIPT_NAME"]));
        $request_uri = str_replace([$dirname, $basename], null, $_SERVER["REQUEST_URI"]) . "/";

        $request_scheme = $_SERVER['REQUEST_SCHEME'];

        if (empty($dirname)) {
            $actual_link = $request_scheme . "://" . $_SERVER['HTTP_HOST'] . "/";
        }
        else {
            $actual_link = $request_scheme . "://" . $_SERVER['HTTP_HOST'] . "/" . $dirname . "/";
        }

        $realPath = realpath(".") . "/";
        $str = str_replace('\\', '/', $realPath);

        define("REQUESTURI", trim($request_uri, "/"));
        define("BASE", $actual_link);
        define("dir", $str);

        define("VIEWS", dir . "views/");
        define("PANEL", dir . "adminpanel/");
        define("SOURCES", BASE . "src/");
        define("POSTS", dir . "posts/");
        define("HELPERS", dir . "helpers/");
        define("LIBRARIES", dir . "libraries/");
        define("ASSETS", BASE . "public/");
        define("VENDOR", dir . "vendor/");

        define("INCLUDES", VIEWS . "includes/");
        define("LAYOUTS", VIEWS . "layouts/");
        define("MODALS", VIEWS . "modals/");
        define("PAGES", VIEWS . "pages/");
        define("SLIDERS", VIEWS . "sliders/");
        define("TEMPLATES", VIEWS . "templates/");


        define("ADMINVIEWS", PANEL . "views/");
        define("ADMINSOURCES", BASE . "adminpanel/public/");

        define("ADMINLAYOUTS", ADMINVIEWS . "layouts/");
        define("ADMININCLUDES", ADMINVIEWS . "includes/");
        define("ADMINPAGES", ADMINVIEWS . "pages/");
    }
}
