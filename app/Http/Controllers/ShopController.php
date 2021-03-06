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

    public function myCart(Cart $cart)
    {
        $data = $cart->showCart();
        return view('mycart', $data);
    }

    public function addMyCart(Request $request, Cart $cart)
    {
        //カートに追加の処理
        $stock_id = $request->stock_id;
        $message = $cart->addCart($stock_id);

        //追加後の情報を取得
        $data = $cart->showCart();

        return view('mycart',$data)->with('message',$message);
    }

    public function deleteCart(Request $request, Cart $cart)
    {
        $stock_id = $request->stock_id;
        $message = $cart->deleteCart($stock_id);

        $data = $cart->showCart();

        return view('mycart',$data)->with('message',$message);
    }

    public function checkout(Cart $cart)
    {
        $checkout_info = $cart->checkoutCart();

        return view('checkout');
    }

    public function showDetail(Request $request, Stock $stock, Cart $cart)
    {
        $id = $request->id;

        // 詳細情報取得
        $details = $stock->detail($id);

        // カート内に含まれているかチェック
        $message = $cart->cartCheck($id);

        return view('detail', [
            'details' => $details,
            'message' => $message
        ]);
    }
}
