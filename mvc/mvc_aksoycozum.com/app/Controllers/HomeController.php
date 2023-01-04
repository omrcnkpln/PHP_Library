<?php

use app\Controllers\BaseController;
use System\Helpers\Helper;

class HomeController extends BaseController
{
    //parametrelerimi controller da işlem yapabilmek için aldım

    public function Index($view = [], $param = false)
    {
        session_start();
        ob_start();

        //bu klasör altına toplama olayı garip oldu
        $page = array();
        $page[1] = $param[1];
        $page[0] = $param[0];

        /**
         * @example
         */

        return self::View($page);
    }

    /**
     * @note formda Home/Index şeklinde kullnaılmalıdır
     */
    public function IndexPost($view = [], $param = false)
    {
        //bu klasör altına toplama olayı garip oldu
        $page = array();
        $page[1] = $param[1];
        $page[0] = $param[0];

        return self::View($page);
    }

    public function Eba($view = [], $param = false)
    {
        //bu klasör altına toplama olayı garip oldu
        $page = array();
        $page[1] = $param[1];
        $page[0] = $param[0];

        /**
         * @example
         */

        return self::View($page);
    }

    public function Qdms($view = [], $param = false)
    {
        //bu klasör altına toplama olayı garip oldu
        $page = array();
        $page[1] = $param[1];
        $page[0] = $param[0];

        /**
         * @example
         */

        return self::View($page);
    }

    public function Ensemble($view = [], $param = false)
    {
        //bu klasör altına toplama olayı garip oldu
        $page = array();
        $page[1] = $param[1];
        $page[0] = $param[0];

        /**
         * @example
         */

        return self::View($page);
    }

    public function Referanslar($view = [], $param = false)
    {
        //bu klasör altına toplama olayı garip oldu
        $page = array();
        $page[1] = $param[1];
        $page[0] = $param[0];

        /**
         * @example
         */

        return self::View($page);
    }
}
