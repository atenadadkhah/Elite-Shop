<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSize extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i<=18;$i++){
            $size_id=[];
            for ($j=0;$j<rand(1,5); $j++){
                $random = rand(1,5);
                while (in_array($random,$size_id)){
                    $random = rand(1,5);
                }
                array_push($size_id,$random);
                DB::table("productsSize")->insert([
                    'product_id' => $i,
                    'size_id' => $random
                ]);
            }
        }
    }
}
