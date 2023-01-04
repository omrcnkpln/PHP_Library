<?php

class verotFotoUpload extends \Verot\Upload\Upload
{
  public function fotoYukle2($image ="", $imageYolu ="", $width="", $height="")
  {
    $rand = uniqid(true);
    $image->file_new_name_body = $rand;
    $mime = $image->file_src_mime;

    if(!empty($width) && !empty($height)){
      $image->image_resize = true;
      $image->image_ratio_crop = true;
      $image->image_x = $width;
      $image->image_y = $height;
    }

    if ($mime == "image/jpeg") {
      $image->image_convert = "jpg";
      $image->image_src_type = "jpg";
      $image->jpeg_quality = 70;
    }
    else if ($mime == "image/png") {
      $image->png_compression = 5;
      $image->image_src_type = "png";
    }
    else if ($mime == "image/webp") {
      $image->webp_quality = 65;
      $image->image_src_type = "webp";
    }

    $image->Process("public/images/" . $imageYolu);

    if ($image->processed) {
      $imageName = $rand . "." . $image->image_src_type;
      return $imageName;
    }
    else {
      return false;
    }
  }

  public function pdfYukle($dosya = "", $dosyaYolu = "")
  {
    $rand = uniqid(true);
    $dosya->file_new_name_body = $rand;

    $dosya->Process("public/uploads/" . $dosyaYolu);

    if ($dosya->processed) {
      $dosyaName = $rand . "." . $dosya->file_src_name_ext;
      return $dosyaName;
    }
    else {
      return false;
    }
  }
}