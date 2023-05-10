<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmpUsers extends Model
{
    protected $table = "tmp_users";
    protected $guarded = [];
    public $timestamps = false;

}
