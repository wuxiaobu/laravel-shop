<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCartRequest;
use App\Models\CartItem;
use Auth;

class CartController extends Controller
{
    public function add(AddCartRequest $request){
        $user   = $request->user();
        $user = Auth::user();
        $skuId  = $request->input('sku_id');
        $amount = $request->input('amount');
        
        $cart = $user->cartItems()->where('product_sku_id', $skuId)->first();
        if(is_null($cart)){
            $cart = new CartItem;
            $cart->user_id = $user->id;
            $cart->product_sku_id = $skuId ;
            $cart->amount = $amount;
            $cart->save();
        } else {
            $cart->update([
                'amount' => $cart->amount + $amount,
            ]);
        }
        return [];
    }
}
