<?php
use OMRCNKPLN\Validators;
use OMRCNKPLN\Database;
use OMRCNKPLN\Helper;


//helpers altındaki dosyalar otomatik dahil edilecek

//otomatik class yükleme
spl_autoload_register(function ($className) {
    $prefix = "OMRCNKPLN\\";

    $base_dir = __DIR__ . "/Libraries/";

//    echo $base_dir;

    // does the class use the namespace prefix?
    $len = strlen($prefix);

    if (strncmp($prefix, $className, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($className, $len);

    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});



//static olduğu için new lemeden çağırabildim
//Helper::load();

$b = Helper::load();

$c = new Database\deneme();
$d = new Validators\testValidator();