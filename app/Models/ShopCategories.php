<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCategories extends Model
{
    protected $table = "shop_categories";
    protected $guarded = [];
    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Products::class,"products_categories","shop_category_id","product_id");
    }

    public function subCategories()
    {
        return $this->hasMany(ShopCategories::class,"sub");
    }

    public function parentCategoty()
    {
        return $this->belongsTo(ShopCategories::class, "sub");
    }


}
