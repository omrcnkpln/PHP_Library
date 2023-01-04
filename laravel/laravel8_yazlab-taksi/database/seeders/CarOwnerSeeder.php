<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CarOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("car_owners")->insert([
            "user_id" => "1",
            "car_id" => "3",
        ]);

        DB::table("car_owners")->insert([
            "user_id" => "1",
            "car_id" => "7",
        ]);

        DB::table("car_owners")->insert([
            "user_id" => "2",
            "car_id" => "12",
        ]);

        DB::table("car_owners")->insert([
            "user_id" => "2",
            "car_id" => "27",
        ]);
    }
}
