<?php

namespace App\Repositories;

use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;

class OrderRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Order';
    }

    /**
     * 取得今天的訂單量
     *
     * @return integer
     */
    public function getTodaySerialNumber()
    {
        return $this->model->whereDate('created_at', Carbon::today())->count() + 1;
    }

    /**
     * 更新訂單資訊
     *
     * @param string $orderNo
     * @param array $attributes
     * @return void
     */
    public function updateOrderByOrderNo($orderNo, $attributes)
    {
        return $this->model->where('order_no', $orderNo)->update($attributes);
    }
}
