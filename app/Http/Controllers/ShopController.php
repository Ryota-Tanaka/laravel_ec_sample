<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stock;
use App\Models\Cart;

class ShopController extends Controller
{
    public function index()
    {
        $stocks = Stock::Paginate(6);
        return view('shop', compact('stocks'));
    }

    public function myCart()
    {
        $carts = Cart::all();
        return view('mycart', compact('carts'));
    }

    public function addMyCart(Request $request)
    {
        $user_id = Auth::id();
        $stock_id = $request->stock_id;

        $cart_add_info = Cart::firstOrCreate([
            'stock_id' => $stock_id,
            'user_id' => $user_id
        ]);

        if ($cart_add_info->wasRecentlyCreated) {
            $message = 'カートに追加しました';
        } else {
            $message = 'カートに登録済みです';
        }

        $my_carts = Cart::where('user_id', $user_id)->get();

        return view('mycart', compact('my_carts', 'message'));
    }
}
