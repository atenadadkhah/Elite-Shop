<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomersOpinion extends Model
{
    protected $table = "customers_opinion";
    protected $guarded = [];
    public $timestamps=false;
    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }

}
