<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Storage\Category\CategoryStorage;
use App\Http\Storage\Product\ProductStorage;
use App\Http\Storage\Slider\SliderStorage;
use Illuminate\Http\Request;

class MainController extends Controller
{

    protected $cate;
    protected $slider;
    protected $product;

    public function __construct(SliderStorage $slider, CategoryStorage $cate, ProductStorage $product){
        $this->slider = $slider;
        $this->cate = $cate;
        $this->product = $product;
    }

    public function index()
    {
        return view('home', [
            'title' => 'Shop',
            'categories' => $this->cate->show(),
            'sliders' => $this->slider->show(),
            'products' => $this->product->show()
        ]);
    }

    public function LoadProducts(Request $request){
        $page = $request->input('page', 0);
        $result = $this->product->show($page);
        if(count($result) != 0){
            $html = view('home.list', ['products' => $result])->render();

            return response()->json([
                'html' => $html
            ]);
        }
        return response()->json([
            'html' => ''
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
