<?php

namespace App\Providers;


use App\Models\Colors;
use App\Models\Orders;
use App\Models\ShopCategories;
use App\Models\Sizes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer('shop', function($view){
            $mainCats = ShopCategories::where("sub",0)->get();
            $catsArr=[];
            foreach($mainCats as $mainCat){
                $subCats=[];
                foreach($mainCat->subCategories as $item){
                    $subCats[]=$item->id;
                }
                $catsArr[$mainCat->id] = \App\Models\ProductsCategories::whereIn("shop_category_id",$subCats)->get();
            }
            $view->with("_productCats",$catsArr);
            $view->with("_categories",ShopCategories::all());
            $view->with("_sizes",Sizes::all());
            $view->with("_colors",Colors::all());
        });

        View::composer('*',function($view){
            $table = Auth::check() ? ('App\Models\UsersCart') : ('App\Models\TmpUsersCart');
            $identifier = Auth::check() ? Auth::user()->id : Cookie::get('device_id');
            $idName =  Auth::check() ? 'user_id' : 'uuid';
            $cart = $table::where($idName, $identifier)->get();
            $sum = 0;
            foreach($cart as $item){
                $sum += $item->product->today_price * $item->quantity;
            }

            $view->with('cartSum',$sum);
            $view->with('_cart',$cart);

            if (Auth::check()){
                $orders = Orders::where('user_id',Auth::user()->id)->with('product.picture')->get();
                $view->with('orders',$orders);
            }
        });


    }
}
