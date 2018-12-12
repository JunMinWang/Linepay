<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\OrderRepository;
use App\Services\BaseCurlService;
use Cart;
use Carbon\Carbon;

class OrderController extends Controller
{
    private $orderRepository;
    private $baseCurlService;

    public function __construct(
        OrderRepository $orderRepository,
        BaseCurlService $baseCurlService
    ) {
        $this->orderRepository = $orderRepository;
        $this->baseCurlService = $baseCurlService;
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
     * @param Request $request
     *
     */
    public function store(Request $request)
    {
        $items = Cart::content();

        $serial = $this->orderRepository->getTodaySerialNumber();

        if ($request->paymentType === '2') {
            $result = $this->baseCurlService->sendToLinepay(
                'https://sandbox-api-pay.line.me/v2/payments/request',
                [
                    'productName' => '停車費',
                    'amount' => countOrderTotal($items),
                    'currency' => 'TWD',
                    'confirmUrl' => route('order.confirm'),
                    'confirmUrlType' => 'SERVER',
                    'orderId' => generateOrderId($serial),
                    'langCd' => 'zh-Hant'
                ]
            );

            if ($result['returnCode'] !== '0000') {
                return back()->with('failed', "linepay error! [" . $result['returnCode'] . "]" . $result['returnMessage']);
            }
        }

        $this->orderRepository->create([
            'order_no' => generateOrderId($serial),
            'items' => serialize($items->toArray()),
            'prices' => countOrderTotal($items),
            'status' => 1,
            'payment_type' => $request->paymentType,
            'payment_status' => '0',
            'user_id' => Auth::id(),
            'memo' => '',
            'created_at' => Carbon::now()
        ]);

        // 記得扣庫存量

        if ($request->paymentType === '2') {
            return redirect()->away($result['info']['paymentUrl']['web']);
        }
        Cart::destroy();
        return redirect()->route('product.list')->with('success', '購買完成');
    }

    /**
     * Linepay confirm 確認付款流程
     *
     * @param Request $request
     * @return void
     */
    public function confirm(Request $request)
    {
        $items = Cart::content();
        $result = $this->baseCurlService->sendToLinepay(
            "https://sandbox-api-pay.line.me/v2/payments/{$request->transactionId}/confirm",
            [
                'amount' => countOrderTotal($items),
                'currency' => 'TWD',
            ]
        );

        if ($result['returnCode'] !== '0000') {
            $str = "[" . $result['returnCode'] . "]" . $result['returnMessage'];
            return redirect()->route('shoppingcart.list')->with('failed', $str);
        }

        $this->orderRepository->updateOrderByOrderNo($result['info']['orderId'], [ 'status' => '3' ]);
        Cart::destroy();
        return redirect()->route('product.list')->with('success', '購買成功');
    }
}
