<?php

namespace App\Http\Controllers;

use App\Models\CarOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {


        echo "login";
//        $user = Auth::user();

//        return view('admin.profile-get', ['user' => $user, 'carInfos' => $carInfos, 'firstLocInfo' => $firstLocInfo]);
    }

    public function register()
    {
        echo "register";
//        $user = Auth::user();

//        return view('admin.profile-get', ['user' => $user, 'carInfos' => $carInfos, 'firstLocInfo' => $firstLocInfo]);
    }
    public function registerPost()
    {


        echo "register oldun";
//        $user = Auth::user();

//        return view('admin.profile-get', ['user' => $user, 'carInfos' => $carInfos, 'firstLocInfo' => $firstLocInfo]);
    }
}
