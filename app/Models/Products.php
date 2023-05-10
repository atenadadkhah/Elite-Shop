<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Products extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $table = "products";
    protected $guarded = [];
    protected $casts = [
        'features' => 'array',
    ];
    public function color()
    {
        return $this->belongsToMany(Colors::class,"products_color","product_id","color_id");
    }
    public function size()
    {
        return $this->belongsToMany(Sizes::class,"products_size","product_id","size_id");
    }
    public function category()
    {
        return $this->belongsToMany(ShopCategories::class,"products_categories","product_id","shop_category_id");
    }

    public function opinion()
    {
        return $this->hasMany(CustomersOpinion::class,"product_id")->orderBy("stars","desc")->orderBy("created_at","desc");
    }

    public function picture()
    {
        return $this->hasOne(Media::class, 'model_id')->where('collection_name','products');
    }


    public function scopeFilter($query)
    {
        if (request('search') !== null){
            $query->where("name","like",'%'.request('search').'%');
        }
        if (request('priceRange')) {
            $query->whereBetween("today_price",request('priceRange'));
        }
        if (request('color')) {
            $query->whereHas('color', function ($query) {
                $query->whereIn('colors.id',request('color'))->orwhere('colors.id',0);
            });
        }
        if (request('size')){
            $query->whereHas('size', function ($query) {
                $query->whereIn('sizes.id',request('size'))->orwhere('sizes.id',0);
            });
        }
        if (request('category')){
            $query->whereHas('category', function ($query) {
                $query->whereIn('shop_categories.sub',request('category'));
            });
        }
        return $query;
    }

    public function scopeSort($query)
    {
        if (request("sort")){
            switch (request("sort")) {
                case '0':
                    $query->orderBy('production_year','desc');
                    break;
                case '1':
                    $query->orderBy("name");
                    break;
                case '2':
                    $query->orderBy("name",'desc');
                    break;
                case '3':
                    $query->withAvg('opinion','stars')->orderBy('opinion_avg_stars','desc');
                    break;
            }
        }
    }



}
