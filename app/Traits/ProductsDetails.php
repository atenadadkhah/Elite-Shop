<?php

namespace App\Traits;

use App\Models\Colors;
use App\Models\Products;
use App\Models\Sizes;

trait ProductsDetails{
    public function product(){
        return $this->belongsTo(Products::class,'product_id');
    }
    public function color(){
        return $this->belongsTo(Colors::class,'color_id');
    }
    public function size(){
        return $this->belongsTo(Sizes::class,'size_id');
    }
}
