<?php

//projenin çalıştığı dizin belirlendi route yapılandırma için gerekli
$dirname = strtolower(dirname($_SERVER["SCRIPT_NAME"]));

$dirname = ltrim($dirname, "/");
$basename = strtolower(basename($_SERVER["SCRIPT_NAME"]));
$request_uri = str_replace([$dirname, $basename], null, $_SERVER["REQUEST_URI"]) . "/";

if(empty($dirname)){
    $actual_link = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']."/";
}else{
    $actual_link = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ."/". $dirname . "/";
}

define("BASE", $actual_link);
define("dir", realpath(".") . "/");

define("MODELS", dir . "app/Models/");
define("VIEWS", dir . "app/Views/");
define("CONTROLLERS", dir . "app/Controllers/");

define("INCLUDES", VIEWS . "Includes/");
define("HELPERS", dir . "app/Helpers/");
define("LIBRARIES", dir . "app/Libraries/");
define("ASSETS", dir . "public/");

