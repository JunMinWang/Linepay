<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class ShoppingCartController extends Controller
{
    /**
     * 取得購物車列表
     *
     * @return Response
     */
    public function index()
    {
        if (Cart::count() < 1) {
            return redirect()->route('product.list');
        }
        $items = Cart::content();
        return view('products.shoppingcart', compact('items'));
    }

    /**
     * 新增項目到購物車
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Cart::add(
            $request->id,
            $request->name,
            $request->quantity,
            $request->price
        );
        return back()->with('success', '成功加入購物車項目!');
    }

    /**
     * 移除購物車項目
     *
     * @param String $id 購物車項目Hash
     * @return Response
     */
    public function remove($id)
    {
        Cart::remove($id);
        return back()->with('success', '成功移除購物車項目!');
    }

    /**
     * 移除購物車所有項目
     *
     * @return Response
     */
    public function removeAll()
    {
        Cart::destroy();
        return redirect()->route('product.list')->with('success', '已移除所有購物車項目!');
    }
}
