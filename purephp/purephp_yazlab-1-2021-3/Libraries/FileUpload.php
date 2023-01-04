<?php
include "Helpers.php";
$helpers = new Helpers();

class FileUpload extends Helpers
{
    private $file;
    private $max_boyut = 2000000;
    public $dosya_adi = "";
    public $uploaded = false;
    public $info;

    public function __construct($file = "", $path = "")
    {
        $this->file = $file;
        $name = $file["name"];
        $temp_name = $file["tmp_name"];
        $size = $file["size"];
        $extension = $this->uzanti($name);
        $new_name = rand(0, 999999) . "." . $extension;

        if ($size < $this->max_boyut) {
            $mime = $file["type"];

            if ($mime == "application/pdf") {
                if (is_uploaded_file($file["tmp_name"])) {
                    $tasi = move_uploaded_file($temp_name, $path . $new_name);

                    if ($tasi) {
                        $this->uploaded = true;
                        $this->dosya_adi = $new_name;
                        return true;
                    }
                    else {
                        $this->uploaded = false;
                        $this->dosya_adi = false;
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        $this->info = "Dosya boyutu en fazla <b> 2mb <b> olabilir !";
        return false;
    }
}