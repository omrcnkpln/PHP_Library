<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ornek;
use App\Http\Controllers\Yonet;
use App\Http\Controllers\Formislemleri;
use App\Http\Controllers\Veritabaniislemleri;
use App\Http\Controllers\Modelislemleri;
use App\Http\Controllers\iletisim;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dene', function (){
    return view('dene');
});

Route::get("/phpTurkiye/{isim}", [Ornek::class,"test"]);

Route::get("/web", [Yonet::class,"site"])->name("bilgi");

Route::get("/form", [Formislemleri::class,"gorunum"]);

Route::middleware("arakontrol")->post("/form-sonuc", [Formislemleri::class,"sonuc"])->name("sonuc");

Route::get("/ekle", [Veritabaniislemleri::class,"ekle"]);

Route::get("/guncelle", [Veritabaniislemleri::class,"guncelle"]);

Route::get("/sil", [Veritabaniislemleri::class,"sil"]);

Route::get("/listele", [Veritabaniislemleri::class,"bilgiler"]);

Route::get("/model-liste", [Modelislemleri::class,"liste"]);

Route::get("/model-ekle", [Modelislemleri::class,"ekle"]);

Route::get("/model-sil", [Modelislemleri::class,"sil"]);

Route::get("/iletisim", [iletisim::class,"index"]);

Route::post("/iletisim-sonuc", [iletisim::class,"ekleme"])->name("iletisim-sonuc");
