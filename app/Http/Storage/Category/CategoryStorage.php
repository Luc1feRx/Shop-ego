<?php

namespace App\Http\Storage\Category;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryStorage {

    public function getList(){ //get list
        return Category::orderBy('id', 'desc')->paginate(10);
    }

    public function show(){ //get list to home
        return Category::
        where('parent_id', 0)->
        orderBy('id', 'desc')->get();
    }

    public function getParentCategory(){ //get parent id
        return Category::where('parent_id', 0)->orderBy('id', 'desc')->get();
    }


    public function create($request){ //add new category
        try{
            Category::create([
                'category_name' => $request->input('category_name'),
                'parent_id' => $request->input('parent_id'),
                'category_description' => $request->input('category_desc'),
                'active' => $request->input('active'),
                'thumb' => $request->input('thumb')
            ]);

            session()->flash('success', 'Thêm Danh Mục Thành Công');
        }catch(\Exception $e){
            session()->flash('error', 'Thêm Danh Mục Thất Bại');
            return false;
        }
        return true;
    }

    public function delete($request){
        $id = $request->input('id');
        $category = Category::where('id', $id)->first();
        if($category){
            return Category::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }

    public function update($category, $request){ //update category
        try{
            if($request->input('parent_id') != $category->id){
                $category->parent_id = (int) $request->input('parent_id');
            }
            $category->category_name = (string) $request->input('category_name');
            $category->category_description = (string) $request->input('category_desc');
            $category->active = (int) $request->input('active');
            $category->thumb = $request->input('thumb');

            $category->save();
            session()->flash('success', 'Cập Nhập Thành Công');
            return true;
        }catch(\Exception $e){
            session()->flash('error', 'Cập Nhập Danh Mục Thất Bại');
            return false;
        }
    }

    public function getId($id){
        return Category::where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getProduct($cates, $request){
        $query = $cates->products()
        ->select('id', 'name', 'price', 'price_sale', 'thumb')
        ->where('active', 1);

        if($request->input('price')){
            $query->orderBy('price', $request->input('price'));
        }
        return $query->orderBy('id', 'desc')
        ->paginate(12)
        ->withQueryString();
    }
}
