<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    protected $table = "colors";
    protected $guarded = [];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsToMany(Products::class,"products_color","color_id","product_id");
    }
}
