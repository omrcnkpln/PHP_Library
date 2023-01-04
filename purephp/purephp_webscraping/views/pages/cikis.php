<?php

// nokta varsa dönen base e yönlendir
use System\Helpers\Helper;

$main_dir = Helper::ForceMvc();

if ($main_dir != false) {
    header("location:" . $main_dir);
}
else {
    session_start();
    $_SESSION["oturum"] = false;
    session_destroy();
    @ob_end_flush();
    header("Location:" . BASE);
}

