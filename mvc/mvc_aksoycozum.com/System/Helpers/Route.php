<?php

namespace System\Helpers;

class Route
{
    private static $uri;

    private static function hasMethod($name, $method)
    {
        if (file_exists(CONTROLLERS . $name . ".php")) {
            require CONTROLLERS . $name . ".php";

            if (class_exists($name)) {
                $request = $_SERVER["REQUEST_METHOD"];

                if ($request == "GET") {
                    if (method_exists($name, $method)) {
                        return $method;
                    }

                    return false;
                }

                //post methodları için methodların sonuna 'Post' eklenip kullanılmalıdır
                if ($request == "POST") {
                    $method .= "Post";

                    if (method_exists($name, $method)) {
                        return $method;
                    }

                    return false;
                }

                return false;
            }

            return false;
        }

        return false;
    }

    private static function filter($str)
    {
        return strip_tags(trim(addslashes($str)));
    }

    private static function filterUrl($str)
    {
        if (is_array($_GET[$str])) {
            return array_map(function ($item) {
                return self::filter($item);
            }, $_GET[$str]);
        }

        return self::filter($_GET[$str]);
    }

    public static function run($prm)
    {
        if (isset($_GET[$prm])) {
            $uri = self::filterUrl($prm);
            $uri = array_filter(explode("/", $uri));
            self::$uri = $uri;

            $controller = self::url(0) . "Controller";
            $method = self::url(1);

            //parametrelerimi dizi halinde gönderecem
//            array_shift(self::$uri);
//            array_shift(self::$uri);

            $prm = self::$uri;
            $hasMethod = self::hasMethod($controller, $method);

            if ($hasMethod) {
                //dizinin ilk elemanı method ismi olmalı
                $prmForMethod = array($hasMethod, $prm);
                call_user_func_array([new $controller, $hasMethod], $prmForMethod);
            }
            else {
                //method bulunamadı
                header("location:" . BASE . "Home/Index");
            }
        }
        else {
            return false;
        }
    }

    public static function url($index)
    {
        //burada filtreleme yapabilirim
        //burası şu anda sadece varsa işlem yap için
        $uri = self::$uri;

        if (isset($uri[$index])) {
            return $uri[$index];
        }

        return false;
    }
}




