<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ybazli\Faker\Facades\Faker;

class CustomersOpinion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('fa_IR');
        for ($i=0;$i<50;$i++){
            DB::table("customers_opinion")->insert([
                "user_id" => rand(1,20),
                "product_id" => rand(1,18),
                "title"=>$faker->realtext(40,2),
                "body"=> mb_substr(Faker::paragraph(),0,100),
                "stars"=>rand(4,5),
                "created_at"=>$faker->dateTimeBetween("-5 years","-10 months",null)
            ]);
        }
    }
}
