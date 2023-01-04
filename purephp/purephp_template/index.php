<?php

require "app/init.php";

$param = get("param");

$param = array_filter(explode("/", $param));

if (!isset($param[0])) {
    $param[0] = "HomeController";
}

if (!file_exists(controller($param[0]))) {
    $param[0] = "HomeController";
}

require controller($param[0]);