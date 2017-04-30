<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Cart;
use App\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = Auth::user()->getCartItems();
        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
            $totalPrice += ($cartItem->quantity * $cartItem->getProduct()->price);
        }

        return view('customer.cart')->with([
            'cartItems'     => $cartItems,
            'totalPrice'    => $totalPrice
        ]);
    }

    public function saveItem(Request $request)
    {
        DB::beginTransaction();
        try {
            $productId = $request->get('id');
            $user = Auth::user();
            if (!$product = Product::find($productId)) {
                throw new ModelNotFoundException('Product does not exist');
            }

            $quantityCondition = 'required|min:1|max:'.$product->stocks_left.'|numeric';
            if ($product->is_made_to_order) {
                $quantityCondition = 'required|min:1|numeric';
            }

            $validator = Validator::make(
                $request->all(),
                ['quantity' => $quantityCondition]
            );
            if ($validator->fails()) {
                return redirect($request->get('urlFrom', 'cart'))
                    ->with(['productId' => $productId])
                    ->withErrors($validator)
                    ->withInput();
            }

            $cartItem = Cart::getItem($user->id, $productId) ?: new Cart();
            $cartItem->fill([
                'user_id'       => $user->id,
                'product_id'    => $productId,
                'quantity'      => $request->get('quantity')
            ])->save();

            $message = array('success' => 'Cart item has been successfully saved');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = array(
                'error' => $e->getMessage()
            );
        }

        return redirect('cart')->with($message);
    }

    public function deleteItem($id)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $product = Product::find($id);
            if (!$product) {
                throw new ModelNotFoundException('Product does not exist');
            }

            $cartItem = Cart::getItem($user->id, $product->id);
            $message = array(
                'success' => 'Cart item "'.$product->name.'" has been successfully deleted'
            );

            $cartItem->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = array(
                'error' => $e->getMessage()
            );
        }

        return redirect('cart')->with($message);
    }
}