<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use mysql_xdevapi\Table;

class Veritabaniislemleri extends Controller
{
    public function ekle(){
        DB::table("bilgiler")->insert([
            "metin" => "Bu ikinci (2) örnek bir metin bilgisidir."
        ]);
    }

    public function guncelle(){
        DB::table("bilgiler")->where("id",1)->update([
           "metin"=>"Bu metin alanı güncellendi"
        ]);
    }

    public function sil()
    {
        DB::table("bilgiler")->where("id",1)->delete();
    }

    public function bilgiler(){
//        $veriler = DB::table("bilgiler")->get();
//
//        foreach ($veriler as $key => $value){
//            echo $value->metin;
//            echo "<br>";
//        }

        $veri = DB::table("bilgiler")->where("id", 2)->first();

        echo $veri->metin;
    }
}
