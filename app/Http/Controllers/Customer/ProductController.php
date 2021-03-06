<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $key = $request->get('key');

        $cartItems = array();
        if ($user = Auth::user()) {
            foreach($user->getCartItems() as $cartItem) {
                $cartItems[$cartItem->product_id] = $cartItem;
            }
        }

        $numTotalProducts = Product::query()
            ->where('is_made_to_order', '=', true)
            ->orWhere([
                ['is_made_to_order', '=', false],
                ['stocks_left', '!=', 0]
            ])
            ->get()
            ->count();
        $products = Product::query()
            ->where('name', 'like', '%'.$key.'%')
            ->where('is_made_to_order', '=', true)
            ->orWhere([
                ['is_made_to_order', '=', false],
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