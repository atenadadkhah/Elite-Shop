<?php

namespace App\Models;

use App\Traits\ProductsDetails;
use Illuminate\Database\Eloquent\Model;

class TmpUsersCart extends Model
{
    use ProductsDetails;
    protected $table = "tmp_users_cart";
    protected $guarded = [];
    public $timestamps = false;

}
