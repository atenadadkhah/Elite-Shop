<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ybazli\Faker\Facades\Faker;


class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0;$i< 72;$i++){
            DB::table("users")->insert([
                'id' => $i+4,
                "name" => Faker::fullName(),
                "email" => $faker->email(),
                "username" => $faker->userName(),
                "password" => bcrypt('123456'),
                "created_at" =>$faker->dateTimeBetween("-3 years","-2 months",null),
                "updated_at"=> $faker->dateTimeBetween("-8 months","-2 months",null)
            ]);
        }

    }
}
