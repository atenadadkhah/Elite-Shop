<?php

namespace App\Listeners;


use App\Models\TmpUsersCart;
use App\Models\UsersCart;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Cookie;

class InsertDeviceID
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        $uuid = Cookie::get('device_id');
        $currentCart = TmpUsersCart::where('uuid',$uuid)->get()->makeHidden(['id','uuid'])->toArray();
        foreach ($currentCart as $item){
            $size = $item['size_id'];
            $pID = $item['product_id'];
            $color = $item['color_id'];
            $quantity = $item['quantity'];
            $identifier = $user['id'];
            $isProduct = UsersCart::where('user_id',$identifier)->where('product_id',$pID)->where('color_id',$color)->where('size_id',$size)->where('quantity',$quantity)->get();

            if (!$isProduct->count()) {
                $isProduct = UsersCart::where('user_id',$identifier)->where('product_id',$pID)->where('color_id',$color)->where('size_id',$size);
                if (!$isProduct->get()->count()) {
                    UsersCart::create([
                        'user_id' => $identifier,
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
            }
        }

    }
}
