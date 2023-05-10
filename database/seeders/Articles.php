<?php

namespace Database\Seeders;

use Faker\Extension\Helper;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ybazli\Faker\Facades\Faker;


class Articles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $faker = Factory::create('fa_IR');
        for ($i=0; $i < 50; $i++){
            $titleAndSlug = $faker->realtext(90,2);
            DB::table("articles")->insert([
                "subject" => $titleAndSlug,
                "body" => str_repeat(Faker::paragraph(),5),
                "image" => "images/blog/blog-post-".rand(1,3).".jpg",
                "slug"=> \bootstrap\Helper\Helper::pslug($titleAndSlug),
                "user_id" => rand(1,20),
                "created_at" =>$faker->dateTimeBetween("-10 years","-10 months",null),
                "updated_at"=> $faker->dateTimeBetween("-8 months","-2 months",null)
            ]);
        }
    }
}
