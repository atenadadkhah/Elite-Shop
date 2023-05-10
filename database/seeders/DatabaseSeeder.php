<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(Articles::class);
//        $this->call(User::class);
        //$this->call(ArticlesCategories::class);
        //$this->call(ProductsColor::class);
        //$this->call(ProductsSize::class);
        $this->call(Products::class);
//        $this->call(CustomersOpinion::class);
//        $this->call(Profiles::class);
//        $this->call(Comments::class);
//        $this->call(Orders::class);
//        $this->call(RoleAndPermission::class);
    }
}
