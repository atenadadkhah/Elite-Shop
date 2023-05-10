<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sizes extends Model
{
    protected $table = "sizes";
    protected $guarded = [];
    public $timestamps = false;
    public function product()
    {
        return $this->belongsToMany(Products::class,"products_size","size_id","product_id");
    }
}
