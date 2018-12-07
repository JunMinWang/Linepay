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
}
