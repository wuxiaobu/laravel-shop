<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCartRequest;
use App\Models\CartItem;
use App\Models\ProductSku;
use Auth;
use Request;

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

    public function index(Request $request)
    {
        $cartItems = Auth::user()->cartItems()->with(['productSku.product'])->get();
        $addresses = Auth::user()->addresses()->orderBy('last_used_at', 'desc')->get();

        return view('cart.index', ['cartItems' => $cartItems,'addresses' => $addresses]);
    }

    public function remove(ProductSku $sku, Request $request)
    {
        Auth::user()->cartItems()->where('product_sku_id', $sku->id)->delete();

        return [];
    }
}
