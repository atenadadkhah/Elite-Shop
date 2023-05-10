<?php

namespace App\Models;

use App\Traits\ProductsDetails;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use ProductsDetails;

    protected $table = "orders";
    protected $guarded = [];
    public $timestamps=false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
