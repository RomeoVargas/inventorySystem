<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Product;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $key = $request->get('key');

        $cartItems = array();
        foreach(Auth::user()->getCartItems() as $cartItem) {
            $cartItems[$cartItem->product_id] = $cartItem;
        }

        $numTotalProducts = Product::query()
            ->where('stocks_left', '!=', 0)
            ->get()
            ->count();
        $products = Product::query()
            ->where([
                ['name', 'like', '%'.$key.'%'],
                ['stocks_left', '!=', 0]
            ])
            ->orderBy('name', 'asc')
            ->get();

        return view('customer.products')->with([
            'cartItems'         => $cartItems,
            'numTotalProducts'  => $numTotalProducts,
            'products'          => $products,
            'key'               => $key
        ]);
    }
}