<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    private string $table;
    private string $identifier;
    private string $idName;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->table = Auth::check() ? ('App\Models\UsersCart') : ('App\Models\TmpUsersCart');
            $this->identifier = Auth::check() ? Auth::user()->id : Cookie::get('device_id');
            $this->idName =  Auth::check() ? 'user_id' : 'uuid';
            return $next($request);
        });
    }

    public function index()
    {
        return view('cart');
    }


    public function store(Request $request)
    {
        $quantity = $request->quantity;
        if ($quantity >= 1){
            $size = $request->size;
            $pID = $request->pRe;
            $color = $request->color;
            $product = Products::where('id',$request->pRe)->first();
            if ($product->instock){
                $isProduct = $this->table::where($this->idName,$this->identifier)->where('product_id',$pID)->where('color_id',$color)->where('size_id',$size)->where('quantity',$quantity)->get();
                if (!$isProduct->count()) {
                    $isProduct = $this->table::where($this->idName,$this->identifier)->where('product_id',$pID)->where('color_id',$color)->where('size_id',$size);
                    if (!$isProduct->get()->count()) {
                        $this->table::create([
                            $this->idName => $this->identifier,
                            'product_id' => $pID,
                            'color_id' => $color,
                            'size_id' => $size,
                            'quantity' => $quantity
                        ]);
                    }
                    else {
                        $isProduct->update([
                            'quantity' => $quantity
                        ]);
                    }
                    return ['quantity' => $quantity];
                }else return ['status' => 'exist'];
            }

        }
    }



    public function update(Request $request, $pID)
    {
        $quantity = $request->quantity;
        $id = openssl_decrypt(base64_decode($pID),'AES-128-ECB','!123456ad');
        $cart = $this->table::where($this->idName, $this->identifier)->where('id',$id)->get();
        if ($cart->count()){
            $this->table::where($this->idName, $this->identifier)->where('id',$id)->update([
                'quantity' => $quantity
            ]);
        }
    }


    public function destroy($pID)
    {
        $id = openssl_decrypt(base64_decode($pID),'AES-128-ECB','!123456ad');
        $cartItem = $this->table::where($this->idName, $this->identifier)->where('id',$id)->get();
        if ($cartItem->count()){
            $this->table::where('id',$id)->delete();
        }
    }
}
