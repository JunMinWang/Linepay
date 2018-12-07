<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use Cart;

class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * 預覽訂單
     *
     * @return void
     */
    public function preview()
    {
        $items = Cart::content();

        return view('orders.preview', [ 'items' => $items, 'total' => countOrderTotal($items) ]);
    }

    /**
     * 新增訂單
     *
     */
    public function store()
    {
        $items = Cart::content();

        $serial = $this->orderRepository->getTodaySerialNumber();

        $this->orderRepository->create([
            'order_no' => generateOrderId($serial),
            'items' => serialize($items),
            'prices' => 0,
            'status' => '',
            'paymentType' => '',
            'paymentStatus' => '',
            'memo' => '',
            'created_at' => Carbon::now()
        ]);
    }
}
