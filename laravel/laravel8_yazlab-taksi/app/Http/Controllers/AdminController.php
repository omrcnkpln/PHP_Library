<?php

namespace App\Http\Controllers;

use App\Models\CarLocation;
use App\Models\CarOwner;
use Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $carInfos = CarOwner::all();
        $firstLocInfo = array(
            "x" => null,
            "y" => null,
        );

        return view('admin.profile-get', ['user' => $user, 'carInfos' => $carInfos, 'firstLocInfo' => $firstLocInfo]);
    }

    public function konumGetir(Request $request)
    {
        $user = Auth::user();
        $carInfos = CarOwner::all();
        $car = $request->input('car');

        $minute = $request->input('minute');
        $firstLocInfo = DB::connection("mongodb")->table('car_locations')->orderBy('date', 'DESC')->first();

//        $firstLocInfo = CarLocation->order
//        $locInfos = CarLocation::where("car_id", "=", $car)->("", "", "");

//        Helper::Pr($firstLocInfo);

        return view('admin.profile-get', ['user' => $user, 'carInfos' => $carInfos, 'firstLocInfo' => $firstLocInfo]);
    }
}
