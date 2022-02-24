<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Storage\Product\ProductStorage;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productStorage;

    public function __construct(ProductStorage $productStorage){
        $this->productStorage = $productStorage;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index', [
            'title' => 'Danh Sách Sản Phẩm',
            'products' => $this->productStorage->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.add', [
            'title' => 'Thêm Sản Phẩm',
            'category' => $this->productStorage->getCategory()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $result = $this->productStorage->insert($request);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.edit', [
            'title' => 'Chỉnh Sửa Sản Phẩm',
            'products_edit' => $product,
            'category' => $this->productStorage->getCategory()
        ]);
    }

    public function ProductDetails($id, $slug = ''){
        $product = $this->productStorage->getId($id);

        return view('home.content', [
            'title' => $product->name,
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $result = $this->productStorage->update($request, $product);
        if ($result) {
            return redirect('admin/products/list');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result = $this->productStorage->delete($request);
        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xóa Thành Công',

            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
}
