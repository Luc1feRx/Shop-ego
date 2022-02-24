<?php

namespace App\Http\View\Composers;

use App\Models\Product;
use Illuminate\View\View;
use Session;

class CartComposer{

    protected $users;

    public function compose(View $view)
    {
        $carts = Session::get('carts');
        if(is_null($carts)){
            return [];
        }

        $productID = array_keys($carts);
        $products = Product::select('id', 'name', 'price', 'price_sale', 'thumb')->where('active', 1)->whereIn('id', $productID)->get();

        $view->with('products', $products);
    }
}
