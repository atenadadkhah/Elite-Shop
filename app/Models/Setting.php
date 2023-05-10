<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $table = "setting";
    protected $guarded = [];
    public $timestamps = false;
    protected $casts = [
        'logo' => 'array',
        'social_media' => 'array',
        'contact' => 'array'
    ];
}
