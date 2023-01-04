<?php

namespace App\Http\Controllers;

use App\Models\CarLocation;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
//        $user = User::all();

//        Helper::Pr($user->all());

        return view('home.anasayfa');
    }

    public function profile(){
        return view('home.profile');
    }

    public function sendLocation(){
        $locs = new CarLocation();

        $locs->car_id = 'deneme metnidir';

        $locs->save();
    }
}
