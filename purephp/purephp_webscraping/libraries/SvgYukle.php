<?php

class svgYukle
{
  private $image;
  private $max_boyut = 2000000;
  public $dosya_adi = "";
  public $uploaded = false;

  public function __construct($image = "", $imageYolu = "")
  {
    $this->image = $image;
    $name = $image["name"];
    $dosya_boyutu = $image["size"];
    $dosya_uzantisi = substr($name, -4, 4);
    $dosya_adi = rand(0, 999999) . $dosya_uzantisi;
    $dosya_yolu = "public/images/" . $imageYolu . "/";

    if ($dosya_boyutu < $this->max_boyut) {
      $mime = $image["type"];
      if ($mime = "image/svg+xml") {
        if (is_uploaded_file($image["tmp_name"])) {
          $tasi = move_uploaded_file($image["tmp_name"], $dosya_yolu . $dosya_adi);

          if ($tasi) {
            $this->uploaded = true;
            $this->dosya_adi = $dosya_adi;
          }
          else {
            $this->uploaded = false;
            $this->dosya_adi = false;
          }
        }
      }
    }
    else {
      echo "Dosya boyutu en fazla <b> 2mb <b> olabilir !";
    }
  }
}