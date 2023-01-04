<?php
$config = array();

$config["db"] = [
    "host" => "localhost",
    "dbname" => "tempdb",
    "username" => "root",
    "password" => ""
];

define("dir", realpath("."));

//define("MODELS", "app/Models/");
define("VIEWS", dir . "/app/Views/");
define("CONTROLLERS", dir . "/app/Controllers/");

//define("INCLUDES", "Includes/");
//define("VENDOR", "vendor/");
//define("HELPERS", "app/Helpers/");
//define("LIBRARIES", "app/Libraries/");