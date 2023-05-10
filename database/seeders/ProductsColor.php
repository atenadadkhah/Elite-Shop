<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsColor extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i<=18;$i++){
            $color_id=[];
            for ($j=0;$j<rand(1,5); $j++){
                $random = rand(1,5);
                while (in_array($random,$color_id)){
                    $random = rand(1,5);
                }
                array_push($color_id,$random);
                DB::table("productsColor")->insert([
                    'product_id' => $i,
                    'color_id' => $random
                ]);
            }
        }
    }
}
