<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsCategories extends Model
{
    protected $table = "products_categories";
    protected $guarded = [];
    public $timestamps = false;
}
