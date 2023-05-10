<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ybazli\Faker\Facades\Faker;

class Comments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('FA_IR');
        for ($i=0;$i<50;$i++){
            DB::table('comments')->insert([
                'user_id' => rand(1,20),
                'body' => mb_substr(Faker::paragraph(),0,rand(50,120)),
                'created_at' =>$faker->dateTimeBetween("-5 years","-2 months",null)
            ]);
        }
    }
}
