<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    /**
     * 取得所有商品
     *
     * @return Response
     */
    public function index() {
        return response()->view('products.lists', ['products' => $this->productRepository->all()]);
    }

    /**
     * 取得商品資訊
     *
     * @param int $id
     * @return Response
     */
    public function show($id) {
        $product = $this->productRepository->find($id);
        return view('products.info', compact('product'));
    }
}
