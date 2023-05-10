<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\TmpUsersCart;
use App\Models\UsersCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ShopController extends Controller
{

    public function getAllProducts(Request $request)
    {
        if ($request->has("search")){
            $products = Products::where("name","like",'%'.$request->search.'%');
            return view("shop",['products'=>$products]);
        }
        return view("shop");
    }

    public function filterProducts(Request $request)
    {
        if (isset($request->action)){
            $products = Products::filter()->sort()->with('picture')->get();
            if ($products->count()) return $products;
            return false;
        }

    }

    public function singleProduct($slug)
    {
        $product = Products::where("slug",$slug)->with('picture')->first();
        if (isset($product)) {
                $table = Auth::check() ? ('App\Models\UsersCart') : ('App\Models\TmpUsersCart');
                $identifier = Auth::check() ? Auth::user()->id : Cookie::get('device_id');
                $idName = Auth::check() ? 'user_id' : 'uuid';
                $cart = $table::where($idName, $identifier)->where('product_id', $product->id)->orderBy('id', 'desc')->first();
                $opinions = $product->opinion->take(3);
                //products with the same sub category id that are more accurate
                $moreSimilarProducts = Products::whereHas('category', function ($q) use ($product) {
                    $q->whereIn("shop_categories.id", $product->category->pluck('id')->toArray());
                })->where('id', '!=', $product->id)->with('picture')->orderBy("production_year", "desc")->get();

                //products with the same main category id
                $lessSimilarProducts = Products::whereHas('category', function ($q) use ($product) {
                    $q->whereIn("shop_categories.sub", $product->category->pluck('sub')->toArray());
                })->where('id', '!=', $product->id)->with('picture')->orderBy("production_year", "desc")->get();

                $similarProducts = $moreSimilarProducts->merge($lessSimilarProducts)->take(4);
                return view("product-single", ["product" => $product, 'opinions' => $opinions, 'similarProducts' => $similarProducts, 'lastCart' => $cart]);

        }
        abort(404);
    }



}
