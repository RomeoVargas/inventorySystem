<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class ProductController extends BaseController
{
    public function index(Request $request)
    {
        $key = $request->get('key');
        $numTotalProducts = Product::query()->get()->count();
        $products = Product::query()
            ->where('name', 'like', '%'.$key.'%')
            ->orderBy('stocks_left', 'asc')
            ->get();

        return view('admin.products')->with([
            'numTotalProducts'  => $numTotalProducts,
            'products'          => $products,
            'key'               => $key
        ]);
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = array(
                'price'                 => 'required|min:1|numeric',
                'stocks'                => 'required|min:0|numeric',
                'description'           => 'required|min:1|max:255',
            );
            $additionalRules = array();
            $hasImageSubmitted = true;
            if ($productId = $request->get('id')) {
                $additionalRules['name'] = 'required|max:'.Product::MAX_LENGTH_NAME.'|unique:products,name,'.$productId;
                if ($hasImageSubmitted = $request->files->has('image')) {
                    $additionalRules['image'] = 'required|mimes:jpeg,jpg,png|max:2048';
                }
            } else {
                $additionalRules = array(
                    'name'                  => 'required|unique:products|max:'.Product::MAX_LENGTH_NAME,
                    'image'                 => 'required|mimes:jpeg,jpg,png|max:2048'
                );
            }

            $rules = array_merge($rules, $additionalRules);

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->redirectTo('products')
                    ->with(['productId' => $productId])
                    ->withErrors($validator)
                    ->withInput();
            }

            $product = $productId ? Product::find($productId) : new Product();
            if (!$product) {
                throw new ModelNotFoundException('Product does not exist');
            }
            $product->fill([
                'name' => $request->get('name'),
                'price' => $request->get('price'),
                'stocks_left' => $request->get('stocks'),
                'description' => $request->get('description')
            ])->save();

            if ($hasImageSubmitted) {
                $newFileName = $product->id.'.jpg';
                $uploadDir = Product::getBaseUploadDir();
                $request->file('image')->move($uploadDir, $newFileName);

                $product->image_url = $newFileName;
                $product->save();
            }

            $successMessage = $productId
                ? 'All changes made to '.$product->name.' has been successfully saved'
                : $product->name.' has been successfully added to products';

            $message = array('success' => $successMessage);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = array(
                'error' => $e->getMessage()
            );
        }

        return $this->redirectTo('products')->with($message);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $product = Product::find($id);
            if (!$product) {
                throw new ModelNotFoundException('Product does not exist');
            }
            $message = array(
                'success' => 'Product "'.$product->name.'" has been successfully deleted'
            );

            $product->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = array(
                'error' => $e->getMessage()
            );
        }

        return $this->redirectTo('products')->with($message);
    }
}