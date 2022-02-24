<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateFormRequest;
use Illuminate\Http\Request;
use App\Http\Storage\Category\CategoryStorage;
use App\Http\Storage\Slider\SliderStorage;
use App\Models\Category;

class CategoryController extends Controller
{

    protected $categoryStorage;
    protected $slider;

    public function __construct(SliderStorage $slider, CategoryStorage $categoryStorage){
        $this->categoryStorage = $categoryStorage;
        $this->slider = $slider;
    }

    public function create(){
        return view('admin.category.add', [
            'title' => 'Thêm Mới Danh Mục',
            'category_parent' => $this->categoryStorage->getParentCategory()
        ]);
    }

    public function save(CreateFormRequest $request) {
        $result = $this->categoryStorage->create($request);
        return redirect()->back();
    }

    public function index() {
        return view('admin.category.index',[
            'title' => 'Danh Sách Danh Mục',
            'getList' => $this->categoryStorage->getList()
        ]);
    }

    public function indexHome(Request $request, $id, $slug = ''){
        $cates = $this->categoryStorage->getId($id);
        $products = $this->categoryStorage->getProduct($cates, $request);

        return view('cate', [
            'title' => $cates->category_name,
            'products' => $products,
            'category' => $cates,
            'sliders' => $this->slider->show(),
            'categories' => $this->categoryStorage->show()
        ]);

    }

    public function delete(Request $request) {
        $result = $this->categoryStorage->delete($request);
        if($result == true){
            return response()->json([
                'error' => false,
                'message' => 'Xóa Thành Công',

            ]);
        }

        return response()->json([
            'error' => true

        ]);
    }

    public function showEdit(Category $category){
        return view('admin.category.edit',[
            'title' => 'Chỉnh Sửa Danh Mục ' . $category->category_name,
            'category' => $category,
            'category_parent' => $this->categoryStorage->getParentCategory()
        ]);
    }

    public function update(Category $category, CreateFormRequest $request){
        $result = $this->categoryStorage->update($category, $request);
        return redirect('admin/categories/list');
    }
}
