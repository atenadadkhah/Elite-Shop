<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Comment;
use Laravelista\Comments\Commentable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Articles extends Model implements HasMedia
{
    use InteractsWithMedia;

    use Commentable ;
    protected $table = "articles";
    protected $guarded = [];
    public $timestamps = false;

    public function category()
    {
        return $this->belongsToMany(Categories::class,"articles_categories","article_id","category_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,"commentable_id");
    }

}
