<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ybazli\Faker\Facades\Faker;


class Products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('fa_IR');
        for ($i=1;$i<=18;$i++) {
            $features=[];
            for ($j = 0; $j<rand(2,6);$j++){
                array_push($features,['feature'=>Faker::sentence()]);
            }

            DB::table("products")->where("id",$i)->update([
                "features"=>json_encode($features, true),
            ]);
        }
    }
}
