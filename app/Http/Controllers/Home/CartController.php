<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Storage\Cart\CartStorage;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{

    protected $cart;

    public function __construct(CartStorage $cartStorage){
        $this->cart = $cartStorage;
    }

    public function index(Request $request)
    {
        $result = $this->cart->create($request);
        if($result == false){
            return redirect()->back();
        }

        return redirect()->route('cart');
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
    public function show(Request $request)
    {
        $product = $this->cart->getProduct($request);

        return view('cart.list', [
            'title' => 'Giỏ Hàng',
            'products' => $product,
            'carts' => Session::get('carts')
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
    public function update(Request $request)
    {
        $result = $this->cart->update($request);
        return redirect()->route('cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = 0)
    {
        $result = $this->cart->delete($id);

        return redirect()->route('cart');
    }
}
