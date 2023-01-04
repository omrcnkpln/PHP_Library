<?php

/**
 * @author omrcnkpln
 * @version 1.0.0
 * @copyright @omrcnkpln
 * Controller dosyaları Controller takısını almalıdır
 * View dosyaları View takısını almalıdır
 * htaccess dosyası yapılandırılmalıdır
 * request type framework tarafından yakalanır
 * post işlemleri yakalanan sayfa Post takısını almalıdır, ilgili Controller klasörü altında olmalıdır
 * form elementi action sayfası controllerAdi/methodAdi şeklinde yapılandırılmalı örn:Home/Index
 */

use System\Helpers\Route;

include 'vendor/autoload.php';

if (isset($_GET["param"])) {
    $uri = Route::run("param");
}
else {
    header("location:Home/Index");
}
