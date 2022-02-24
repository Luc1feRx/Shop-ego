<?php

namespace App\Http\Storage\Product;

use App\Models\Product;
use App\Models\Category;
use SerializesModels;

class ProductStorage{
    const LIMIT = 16;

    public function getCategory(){
        return Category::where('active', 1)->get();
    }

    protected function isValidPrice($request){
        $price = $request->input('product_price');
        $sale_price = $request->input('product_price_sale');
        if($price != 0 && $sale_price != 0 && $sale_price >= $price){
            session()->flash('error', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }

        if($sale_price != 0 && $price == 0){
            session()->flash('error', 'Vui lòng nhập giá gốc');
            return false;
        }

        return true;
    }

    public function insert($request){
        $validRequest = $this->isValidPrice($request);
        if($validRequest == false) return false;

        try{
            $request->except('_token');
            Product::create([
                'name' => $request->input('product_name'),
                'description' => $request->input('product_description'),
                'content' => $request->input('product_content'),
                'category_id' => $request->input('category_id'),
                'price' => $request->input('product_price'),
                'price_sale' => $request->input('product_price_sale'),
                'active' => $request->input('active'),
                'thumb' => $request->input('thumb')
            ]);
            session()->flash('success', 'Thêm Sản Phẩm Thành Công');
        }catch(\Exception $e){
            session()->flash('error', $e);
            return false;
        }

        return true;
    }

    public function get(){
        return Product::
        with('category')->orderBy('id', 'desc')->paginate(15);
    }

    public function update($request, $product){
        $validRequest = $this->isValidPrice($request);
        if($validRequest == false) return false;

        try{
            $product->fill($request->input());
            $product->save();
            session()->flash('success', 'Cập Nhật Sản Phẩm Thành Công');
        }catch(\Exception $e){
            session()->flash('error', $e);
            return false;
        }

        return true;
    }

    public function delete($request){
        $product = Product::where('id', $request->input('id'))->first();
        if($product){
            $product->delete();
            return true;
        }

        return false;

    }

    public function show($page = null) { //get product to homepage
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')->orderBy('id', 'desc')
        ->when($page != null, function ($query) use ($page){
            $query->offset($page * self::LIMIT);
        })
        ->limit(self::LIMIT)->get();
    }

    public function getId($id){
        return Product::where('id', $id)->where('active', 1)->with('category')->firstOrFail();
    }

}
