<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ybazli\Faker\Facades\Faker;

class Profiles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create("fa_IR");
        for ($i = 4; $i<=75;$i++){
            DB::table("profiles")->insert([
                "phone"=>$faker->e164PhoneNumber,
                "about" => Faker::sentence(),
                "country" => Faker::state(),
                "birth" => $faker->date(),
                "user_id"=>$i
            ]);
        }
    }
}
