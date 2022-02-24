<?php

namespace App\Http\Storage\Cart;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Session;

class CartStorage{

    public function create($request){
        $errorMessage = 'Số lượng hoặc sản phẩm không chính xác';
        $sucessMessage = '';
        $qty = $request->input('num-product');
        $product_id = $request->input('product_id');

        if($qty <= 0 || $product_id <= 0){
            $request->session()->flash('error', $errorMessage);
            return false;
        }


        $carts = $request->session()->get('carts');
        if(is_null($carts)){
            $request->session()->put('carts', [
                $product_id => $qty
            ]);

            return true;
        }

        $exists = Arr::exists($carts, $product_id); //update carts dua tren id san pham
        if($exists == true){
            $carts[$product_id] = $carts[$product_id] + $qty;
            session()->put('carts', $carts);
            return true;
        }

        $carts[$product_id] = $qty;
        session()->put('carts', $carts);
        return true;

    }

    public function getProduct($request){
        $carts = Session::get('carts');
        if(is_null($carts)){
            return [];
        }

        $productID = array_keys($carts);
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')->where('active', 1)->whereIn('id', $productID)->get();
    }

    public function update($request){
        $request->session()->put('carts', $request->input('num_product'));
        return true;
    }

    public function delete($id){
        $carts = Session::get('carts');
        unset($carts[$id]);

        session()->put('carts', $carts);
        return true;
    }
}
