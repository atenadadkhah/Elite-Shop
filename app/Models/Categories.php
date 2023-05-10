<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = "categories";
    protected $guarded = [];
    public $timestamps = false;

    public function articles()
    {
        return $this->belongsToMany(Articles::class,"articles_categories","category_id","article_id");
    }
}
