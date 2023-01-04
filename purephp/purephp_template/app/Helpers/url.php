<?php

function filterUrl($str)
{
    return htmlspecialchars(trim($str));
}

function get($url)
{
    if (isset($_GET[$url])) {

        if (is_array($_GET[$url])) {
            return array_map(function ($item) {
                return filterUrl($item);
            }, $_GET[$url]);
        }

        return filterUrl($_GET[$url]);
    }
    else {
        return false;
    }
}

function post($url)
{
    if (isset($_POST[$url])) {

        if (is_array($_POST[$url])) {
            return array_map(function ($item) {
                return filterUrl($item);
            }, $_POST[$url]);
        }
        return filterUrl($_POST[$url]);
    }
    else {
        return false;
    }
}

function url($index){
    global $param;

    if(isset($param[$index])){
        return $param[$index];
    }

    return false;
}



