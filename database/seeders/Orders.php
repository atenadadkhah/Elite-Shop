<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Orders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i=69;$i<119;$i++){
            $from = rand(0, 30);
            DB::table('orders')->where('id', $i)->update([
                'reference'=> 'PAY' . substr(sha1(microtime()), $from,  6)
            ]);
        }
    }
}
