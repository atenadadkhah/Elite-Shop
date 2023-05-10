<?php

namespace App\Models;

use App\Traits\ProductsDetails;
use Illuminate\Database\Eloquent\Model;

class UsersCart extends Model
{
    use ProductsDetails;
    protected $table = "users_cart";
    protected $guarded = [];
    public $timestamps = false;
}
