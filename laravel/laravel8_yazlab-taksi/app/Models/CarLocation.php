<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model;


class CarLocation extends Model
{
//    use HasFactory;
    protected $connection = 'mongodb';
    protected $table = "car_locations";
    protected $fillable = ["car_id", "x", "y", "date"];
}
