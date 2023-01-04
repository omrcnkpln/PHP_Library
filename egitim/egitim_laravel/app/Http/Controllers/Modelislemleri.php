<?php

namespace App\Http\Controllers;

use App\Models\bilgiler;

class Modelislemleri extends Controller
{
    public function liste()
    {
//        $content = bilgiler::get();
//        $content = bilgiler::where("id",2)->first();
//        $content = bilgiler::whereId(2)->first();
//        $content = bilgiler::whereMetin("Bu ikinci (2) örnek bir metin bilgisidir.")->first();
        $content = bilgiler::find(2);

        echo $content->metin;
    }

    public function ekle(){
        bilgiler::create([
            "metin" => "Model dosyasından eklendi",
        ]);
    }

    public function guncelle(){
        bilgiler::whereId(3)->update([
           "metin" => "Modelden güncelendi",
        ]);
    }

    public function sil(){
        bilgiler::whereId(3)->delete();
    }
}
