<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i<=50;$i++){
            $tag_id=[];
            for ($j=0;$j<rand(1,4); $j++){
                $random = rand(1,6);
                while (in_array($random,$tag_id,)){
                    $random = rand(1,6);
                }
                array_push($tag_id,$random);
                DB::table("articles_categories")->insert([
                    'article_id' => $i,
                    'category_id' => $random
                ]);
            }
        }
    }
}
