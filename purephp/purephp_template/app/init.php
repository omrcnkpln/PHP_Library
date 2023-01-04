<?php
//libraries altındaki dosyalar otomatik dahil edilecek
spl_autoload_register(function ($className) {

    $classFile = realpath(".") . "/app/Libraries/" . strtolower($className) . ".php";

    if (file_exists($classFile)) {
        require $classFile;
    }
});

//static olduğu için new lemeden çağırabildim
Helper::load();

//config
require "System/config.php";

$db = new basicdb($config["db"]["host"], $config["db"]["dbname"], $config["db"]["username"], $config["db"]["password"]);